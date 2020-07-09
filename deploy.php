<?php

namespace Deployer;

use Deployer\Utility\Httpie;

require 'recipe/laravel.php';
require 'recipe/slack.php';
require 'recipe/rsync.php';

// Project name
set('application', 'mapos');

// Project repository
set('repository', 'https://github.com/map-os/mapos.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

set('ssh_multiplexing', true); // Speed up deployment

set('rsync_src', function () {
    return __DIR__; // If your project isn't in the root, you'll need to change this.
});

set('slack_webhook', getenv('SLACK_WEBHOOK'));

// Deploy message
set('slack_text', '_{{user}}_ fazendo deploy do branch: `{{branch}}` em: *{{target}}*');
set('slack_success_text', 'Deploy em: *{{target}}* realizado com sucesso!');
set('slack_failure_text', 'Deploy em: *{{target}}* falhou!');

set('rsync_src', function () {
    return __DIR__; // If your project isn't in the root, you'll need to change this.
});

// Configuring the rsync exclusions.
// You'll want to exclude anything that you don't want on the production server.
add('rsync', [
    'exclude' => [
        '.git',
        '/.env',
        '/storage/',
        '/vendor/',
        '/node_modules/',
        '.github',
        'deploy.php',
    ],
]);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// Hosts
host('mapos') // Name of the server
    ->hostname('34.67.170.22') // Hostname or IP address
    ->stage('production') // Deployment stage (production, staging, etc)
    ->user('gbine') // SSH user
    ->set('deploy_path', '~/{{application}}'); // Deploy path

// Tasks

// Set up a deployer task to copy secrets to the server.
// Grabs the dotenv file from the github secret
task('deploy:secrets', function () {
    file_put_contents(__DIR__.'/.env', getenv('DOT_ENV'));
    upload('.env', get('deploy_path').'/shared');
});

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

desc('Deploy the application');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'rsync', // Deploy code & built assets
    'deploy:secrets', // Deploy secrets
    'deploy:shared',
    'deploy:vendors',
    'deploy:writable',
    'artisan:storage:link', // |
    'artisan:view:cache',   // |
    'artisan:config:cache', // | Laravel specific steps
    'artisan:optimize',     // |
    'artisan:migrate',      // |
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
]);

desc('Notifying Slack');
task('slack:notify', function () {
    if (! get('slack_webhook', false)) {
        return;
    }

    $attachment = [
        'title' => get('slack_title'),
        'text' => get('slack_text'),
        'color' => get('slack_color'),
        'mrkdwn_in' => ['text'],
    ];

    Httpie::post(get('slack_webhook'))->setopt(CURLOPT_TIMEOUT, 50)->setopt(CURLOPT_CONNECTTIMEOUT, 50)->body(['attachments' => [$attachment]])->send();
})
    ->setPrivate();

desc('Notifying Slack about deploy finish');
task('slack:notify:success', function () {
    if (! get('slack_webhook', false)) {
        return;
    }

    $attachment = [
        'title' => get('slack_title'),
        'text' => get('slack_success_text'),
        'color' => get('slack_success_color'),
        'mrkdwn_in' => ['text'],
    ];

    Httpie::post(get('slack_webhook'))->setopt(CURLOPT_TIMEOUT, 50)->setopt(CURLOPT_CONNECTTIMEOUT, 50)->body(['attachments' => [$attachment]])->send();
})
    ->setPrivate();

desc('Notifying Slack about deploy failure');
task('slack:notify:failure', function () {
    if (! get('slack_webhook', false)) {
        return;
    }

    $attachment = [
        'title' => get('slack_title'),
        'text' => get('slack_failure_text'),
        'color' => get('slack_failure_color'),
        'mrkdwn_in' => ['text'],
    ];

    Httpie::post(get('slack_webhook'))->setopt(CURLOPT_TIMEOUT, 50)->setopt(CURLOPT_CONNECTTIMEOUT, 50)->body(['attachments' => [$attachment]])->send();
})
    ->setPrivate();

before('deploy', 'slack:notify');

after('deploy:failed', 'slack:notify:failure');

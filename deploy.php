<?php

namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'api.medit');

// Project repository
set('repository', 'git@github.com:medit-id/test.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('api.medit.id')
    ->stage('production')
    ->user('hi_fathur_rohman_gmail_com')
    ->identityFile('/Users/cookies/.ssh/google_compute_engine')
    ->set('deploy_path', '/home/ubuntu/sites/{{application}}');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');


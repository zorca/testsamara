<?php
namespace Deployer;

require 'recipe/common.php';

// Functions

/**
 * Execute commands on local machine without environment variables
 *
 * @param string $command Command to run locally.
 * @param array $options
 * @return string Output of command.
 */
function runLocallyClean($command, $options = [])
{
    $process = Deployer::get()->processRunner;
    $command = parse($command);
    $output = $process->run('localhost', $command, $options);
    return rtrim($output);
}

// Windows or NOT
function check_win()
{
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        return true;
    }
    return false;
}

// Configuration file
inventory('deploy.yml');

// Shared files/dirs between deploys
set('shared_files', []);
set('shared_dirs', []);

// Writable dirs by web server
set('writable_dirs', []);

// Date
set('date', date('d-m-Y_H-i-s'));

// Fix for Runcloud server
set('env', [
    'PATH' => '/home/runcloud/bin:/home/runcloud/.local/bin:/RunCloud/Packages/php71rc/bin:/RunCloud/Packages/httpd-rc/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/snap/bin',
]);

// Tasks

desc('Export current database');
task('local:export:database', function () {
    $local_database_current = 'current.sql';
    runLocallyClean('wp db export --add-drop-table '.$local_database_current);
});

desc('Upload current database');
task('local:upload:database', function () {
    upload('current.sql', get('domain_folder').'/current.sql');
});

// Import database
desc('Database import');
task('import:db', function () {
    run('cd '.get('domain_folder').' && wp db import current.sql');
    // Search-replace domain name
    run('cd '.get('domain_folder').' && wp search-replace '.get('domain_local').' '.get('domain_remote'));
});

// Push all from local to remote
desc('Push all from local to remote');
task('push', [
    'push:wp-content',
    'push:db',
]);

// Push db from local to remote
desc('Push db from local to remote');
task('push:db', [
    'local:export:database',
    'local:upload:database',
    'import:db'
]);

// Push wp-content from local to remote
desc('Push themes from local to remote');
task('push:wp-content', function () {
    upload('wp-content', get('domain_folder'));
});

// Push themes from local to remote
desc('Push themes from local to remote');
task('push:themes', function () {
    upload('wp-content/themes', get('domain_folder').'/wp-content');
});

// Push uploads from local to remote
desc('Push uploads from local to remote');
task('push:uploads', function () {
    upload('wp-content/uploads', get('domain_folder').'/wp-content');
});

// Export remote database
desc('Export remote database');
task('remote:export:db', function () {
    run('cd '.get('domain_folder').' && wp db export --add-drop-table current.sql');
});

// Download database from remote
desc('Download database from remote');
task('download:db', function () {
    download(get('domain_folder').'/current.sql', 'current.sql');
});

// Import local database
desc('Import local database');
task('local:import:db', function () {
    runLocallyClean('wp db import current.sql');
    runLocallyClean('wp search-replace '.get('domain_remote').' '.get('domain_local'));
});

// Pull db from remote to local
desc('Pull db from remote to local');
task('pull:db', [
    'remote:export:db',
    'download:db',
    'local:import:db'
]);

// Pull themes from remote to local
desc('Pull themes from remote to local');
task('pull:themes', function () {
    download(get('domain_folder').'/htdocs/content/themes', 'htdocs/content');
});

// Pull uploads from remote to local
desc('Pull uploads from remote to local');
task('pull:uploads', function () {
    download(get('domain_folder').'/htdocs/content/uploads', 'htdocs/content');
});

// Pull wp-content from remote to local
desc('Pull wp-content from remote to local');
task('pull:wp-content', function () {
    download(get('domain_folder').'/wp-content', '.');
});

// Pull all from remote to local
desc('Pull all from remote to local');
task('pull', [
    'pull:wp-content',
    'pull:db',
]);

desc('Installing vendors');
task('deploy:vendors', function () {
    if (!commandExist('unzip')) {
        writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
    }
    writeln('cd {{release_path}} && composer install');
    run('cd {{release_path}} && composer install');
});

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'rsync:deploy',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

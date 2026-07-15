<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup database harian dengan retensi 7 hari';

    public function handle()
    {
        $backupPath = storage_path('app/backup');

        if (!is_dir($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $fullPath = $backupPath . DIRECTORY_SEPARATOR . $filename;

        $mysqldump = 'C:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe';

        $command = sprintf(
            '"%s" -h %s -u %s %s %s > "%s"',
            $mysqldump,
            env('DB_HOST'),
            env('DB_USERNAME'),
            env('DB_PASSWORD') ? '-p' . env('DB_PASSWORD') : '',
            env('DB_DATABASE'),
            $fullPath
        );

        exec($command, $output, $result);

        if ($result !== 0) {
            \Log::error('Backup gagal', compact('command', 'output'));
            $this->error('Backup GAGAL');
            return Command::FAILURE;
        }

        // Retensi 7 hari
        foreach (glob($backupPath . DIRECTORY_SEPARATOR . '*.sql') as $file) {
            if (filemtime($file) < strtotime('-7 days')) {
                unlink($file);
            }
        }

        $this->info('Backup berhasil: ' . $filename);
    }
}

<?php


class Database
{
    public PDO $pdo;

    protected static string $dsn = 'mysql:host-localhost;port=3306;dbname=floatycruncher';
    protected static string $user = 'root';
    protected static string $password = '';
    //Essentially we'd set them in the .env file as the one I included in the root dir and use ENV files

    /**
     * Database constructor.
     */
    public function __construct()
    {

        $this->pdo = new PDO(self::$dsn, self::$user, self::$password);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);



    }

    public function applyMigration()
    {

        $this->createMigrationsTable();
        $appliedMigrations = $this->getApplicationMigrations();

        $newMigrations = array();
        $files = scandir(Application::$ROOT_DIR.'/Migrations');

        $migrationsToApply = array_diff($files, $appliedMigrations);

        foreach ($migrationsToApply as $migration)
        {

            if($migration === '.' || $migration ==='..')
            {
                continue;
            }

            require_once(Application::$ROOT_DIR.'/Migrations/'.$migration);
            $classname = pathinfo($migration, PATHINFO_FILENAME);

            $classInstance = new $classname();
            $this->log('Applying migration '.$migration);

            $classInstance->up();

            $this->log ('Applied migration '.$migration);

            $newMigrations[] = $migration;

        }

        if(!empty($newMigrations))

        {

            $this->saveMigrations($newMigrations);

        }
        else
        {

            $this->log('All migrations complete.');

        }
    }

    public function createMigrationsTable()

    {

        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ) ENGINE=INNODB;");

    }

    private function getApplicationMigrations(): array
    {

        $stmt = $this->pdo->prepare("SELECT migration FROM migrations");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function saveMigrations(array $newMigrations)
    {

        $str = implode(",", array_map(fn($m) => "('$m')" , $newMigrations));

        $stmt = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str;");
        $stmt->execute();

    }

    protected function log($msg)
    {

        echo '[' . date("Y-m-d H:i:s") .'] - ' . $msg . PHP_EOL;

    }
}
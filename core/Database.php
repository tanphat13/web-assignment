<?php
namespace app\core;

class Database{
    public \PDO $pdo;
    public function __construct(array $config){
        $dsn =$config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        $this->pdo = new \PDO($dsn,$user,$password);

        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }
    public function applyMigrations(){
        $this->createMigrationTable();
        $appliedMigartions = $this->getAppliedMigration();
        $newMigatrions=[];
        $file =  scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff($file,$appliedMigartions);
        var_dump( $toApplyMigrations);
        foreach($toApplyMigrations as $migration){
            if($migration==='.' ||$migration==='..'){
                continue;
            }
            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $object = pathinfo($migration,PATHINFO_FILENAME);
            $instance = new $object();
            $instance->up();
            $newMigatrions[]=$migration;

            if(!empty($newMigatrions)){
                $this->saveMigration($newMigatrions);
            }else{
                echo "All migrations is applied";
            }
        }
    }
    public function  createMigrationTable(){
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;");
    }
    public function getAppliedMigration(){
        $sql_command = $this->pdo->prepare("SELECT migration FROM migrations");
        $sql_command->execute();
        return $sql_command->fetchAll(\PDO::FETCH_COLUMN); 
    }
    public function saveMigration(array $newMigration){
        $newMigration =  implode(",",array_map(fn($m)=>"('$m')", $newMigration));
        $sql_command = $this->pdo->prepare("
            INSERT INTO migrations (migration) VALUES  $newMigration
        ");
        $sql_command->execute();

    }


    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }
}


?>
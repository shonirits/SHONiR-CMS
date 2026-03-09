<?php namespace App\Models;
use CodeIgniter\Model;

class BaseModel extends Model
{
    protected array $cc = [];
    protected array $ccp = [];

    public function coreConfig(int $config_mode = 0): array
    {
        // If already loaded, return cached
        if (!empty($this->cc)) {
            return $config_mode ? $this->ccp : $this->cc;
        }

        $results = $this->db->table('tbl_config')->get()->getResultArray();

        foreach ($results as $row) {
            $this->cc[$row['config_key']] = $row['config_value'];

            if ((int)$row['config_mode'] === 1) {
                $this->ccp[$row['config_key']] = $row['config_value'];
            }
        }

        return $config_mode ? $this->ccp : $this->cc;
    }

    public function getAllConfig(): array
    {
        return $this->coreConfig(0);
    }

    public function getPublicConfig(): array
    {
        return $this->coreConfig(1);
    }
}

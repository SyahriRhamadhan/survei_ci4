<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyTokens extends Model
{
    protected $table      = 'survey_tokens';
    protected $primaryKey = 'id';

    protected $allowedFields = ['token', 'id_survei', 'used'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'token'    => 'required|is_unique[survey_tokens.token]',
        'id_survei' => 'required|integer',
        'used'      => 'required|in_list[0,1]', 
    ];

    protected $validationMessages = [
        'token' => [
            'is_unique' => 'Token sudah terdaftar.',
        ],
        'id_survei' => [
            'required' => 'ID survei harus ada.',
        ],
        'used' => [
            'in_list' => 'Status used harus berupa 0 atau 1.',
        ],
    ];

    public function getTokenBySurveyIdAndToken($id_survei, $token)
    {
        return $this->where('id_survei', $id_survei)
            ->where('token', $token)
            ->first();
    }
    public function markTokenAsUsed($tokenId)
    {
        return $this->update($tokenId, ['used' => true]);
    }

    public function generateNewToken($id_survei)
    {
        $token = bin2hex(random_bytes(16));
        $this->save([
            'token'    => $token,
            'id_survei' => $id_survei,
            'used'     => false,
        ]);
        return $token;
    }
}

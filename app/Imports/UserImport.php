<?php

namespace App\Imports;

use App\Modules\Admin\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;


class UserImport implements ToModel,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        
            return new Question([
                'question' => $row[0],
               'category' => $row[1], 
               'option1' => $row[2],
               'option2' => $row[3],
               'option3' => $row[4],
               'option4' => $row[5],
               'answer' => $row[6],
            ]);
        }

    public function rules(): array

    {
        return 
        [
            '*.0' => 'required',
               '*.1' => 'required', 
               '*.2' => 'required',
               '*.3' => 'required',
               '*.4' => 'required',
               '*.5' => 'required',
               '*.6' => 'required',
        ];
    }
}

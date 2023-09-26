<?php

namespace App\Enums\Teacher;

enum TeacherEducationLevel: string
{
    case Master = 'master';
    case Doctor = 'doctor';
    case AssociateProfessor = 'associate_professor';
    case Professor = 'professor';
}

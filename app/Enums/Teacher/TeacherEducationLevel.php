<?php

namespace App\Enums\Teacher;

enum TeacherEducationLevel: string
{
    case MASTER = 'master';
    case DOCTOR = 'doctor';
    case ASSOCIATE_PROFESSOR = 'associate_professor';
    case PROFESSOR = 'professor';
}

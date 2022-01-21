<?php

namespace Src;


class UserInOut
{
    public function askUser($question)
    {
        return readline($question);
    }


    public function answerUser($answer)
    {
        print ($answer);
    }
}

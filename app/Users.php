<?php

class Users {
    const F_NAME = '';
    const M_NAME = '';
    const L_NAME = '';

    private array $users;
    public function add($users): void
    {
        if (!isset($users)) {
            return;
        }
        if (is_array($users)) {
            foreach ($users as $item) {
                if ($this->validate($item)) {
                    $this->users[] = $this->splitName($item);
                }
            }
        }
        else {
            if ($this->validate($users)) {
                $this->users[] = $this->splitName($users);
            }
        }
    }
    private function splitName($users): array
    {
        $split_names = preg_split('/\s+/', $users);
        switch(count($split_names)) {
            case 1:
                list($f) = $split_names;
                break;
            case 2:
                list($f, $l) = $split_names;
                break;
            case 3:
                list($f, $m, $l) = $split_names;
                break;
        }
        return [
            self::F_NAME => $f ?? null,
            self::M_NAME => $m ?? null,
            self::L_NAME => $l ?? null,
        ];
    }
    private function validate(string $users): ?string
    {
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $users) && (preg_match('/\d/', $users))) {
            return null;
        } else {
            return $users;
        }
    }
    public function getSpecialUser(): ?string
    {
        if(isset($this->users) && is_array($this->users)) {
            return null;
        }
        else {
            usort($this->users, function($ar1, $ar2){
                return strcmp($ar1[self::F_NAME], $ar2[self::F_NAME]);
            });
            if  ($this->users) {
                return [self::L_NAME];
            } else {
                return null;
            }
        }
    }
}

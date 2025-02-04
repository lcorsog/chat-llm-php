<?php

class Rules
{
    public $id;
    public $ruleName;
    public $rules;
    public $user_id;
}

interface RulesDAOInterface
{
    public function buildRules($data);
    // TODO: Implementar o segundo parametro $authUser
    public function create(Rules $rules, $ruleName);
    public function update(Rules $rules, $redirect = true);
}

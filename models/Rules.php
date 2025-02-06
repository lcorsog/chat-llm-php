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
    public function getRulesByUserId($user_id);
    public function defineDefaultRules($user_id);
    // TODO: Implementar o segundo parametro $authUser
    public function create(Rules $rules);
    public function update(Rules $rules);
}

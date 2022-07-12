<?php


namespace App\Scopes;
use illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

class ReverseScope implements Scope
{
public function apply (Builder $builder, Model $model){
    $builder->orderBy('id', 'desc');
}

}

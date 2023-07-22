<?php
namespace App\Services;

use App\Models\Examp;


class ExampleService
{
    //  data :: array
//  id  :: int
    function store(array $data)
    {
        $examp = Examp::Create($data);
        return $examp;

    }

    public function getAll($orderBys = [], $defaul = 10)
    {
        $query = Examp::query();
        if ($orderBys) {
            $query->orderBy($orderBys['column'], $orderBys['sort']);
        }

        return $query->paginate($defaul);

    }


    function show($id)
    {
        $examp = Examp::find($id);
        return $examp;
    }

    //update
    public function update(array $data, $id)
    {
        $examp = Examp::find($id);
        if (!$examp) {
            throw new \Exception('not found examp');
        }
        $examp->update($data);
        return $examp;

    }


    //deltete 
    function destroy  ($ids =[]) {
        $examp = Examp::destroy($ids);
        if (!$examp) {
            throw new \Exception('not found examp');
        }
        
        return $examp;
    }

}



?>
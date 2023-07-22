<?php

namespace App\Http\Controllers;

use App\Models\Examp;
use App\Http\Requests\StoreExampRequest;
use App\Http\Requests\UpdateExampRequest;
use App\Services\ExampleService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use Symfony\Component\HttpFoundation\Response;

class ExampController extends Controller
{
    private $exampService;
    function __construct(ExampleService $exampService)
    {
        $this->exampService = $exampService;
    }

    public function index(Request $request)
    {
        try {
            $limit = $request->get('limit') ?? config('app.pagination.per_page');
            $column = $request->get('column');
            $sort = $request->get('sort');
            $orderBys = [];
            if ($column && $sort) {
                $orderBys['column'] = $column;
                $orderBys['sort'] = $sort;

            }
            $examps = $this->exampService->getAll($orderBys, $limit);
            return response()->json(
                [
                    'status' => true,
                    'code' => Response::HTTP_OK,
                    'data' => $examps->items(),
                    'meta' => [
                        'total' => $examps->total(),
                        'perPage' => $examps->perPage(),
                        'currentPage' => $examps->currentPage()
                    ],
                ]
            );

        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            );
        }

    }


    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'name' => 'required|max:50',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }

            $examp = $this->exampService->store($input);
            // $examp = Examp::Create($input);

            return response()->json([
                'status' => true,
                'code' => Response::HTTP_CREATED,
                'data' => $examp,
            ]);

        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'code' => Response::HTTP_BAD_REQUEST,
                    'message' => $e->getMessage()
                ]
            );
        }

    }


    public function show($id)
    {
        try {
            $examp = $this->exampService->show($id);
            if (!$examp) {
                throw new \Exception('Examp not found');
            }
            return response()->json(
                [
                    'status' => true,
                    'code' => Response::HTTP_OK,
                    'data' => $examp,
                ]
            );

        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => false,
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            );
        }
    }
    public function update(Request $request, $id)
    {
        //
        try {
            $input = $request->only('name');
            $validator = Validator::make($input, [
                'name' => 'required|max:50',
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first());
            }
            $examp = $this->exampService->update($input, $id);
            return response()->json(
                [
                    'status' => true,
                    'code' => Response::HTTP_OK,
                    'data' => $examp,
                ]
            );

        } catch (\Exception $e) {

            return response()->json(
                [
                    'status' => false,
                    'code' => $e->getCode(),
                    'message' => $e->getMessage()
                ]
            );
        }


    }


    public function destroy($id)
    {

        try {
            $this->exampService->destroy($id);
            return response()->json(
                [
                    'status' => true,
                    'code' => Response::HTTP_OK,
                    'message' => 'Examp deleted successfully',
                    'data' => null,
                ]
            );
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }
}
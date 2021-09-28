<?php

namespace App\Http\Controllers;

use App\Helpers\Wizard;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    use Wizard;

    /**
     * @var Produto
     */
    protected $pro;

    public function  __construct()
    {
        header('Access-Control-Allow-Origin: *');
        $this->pro = new Produto();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $produto = $this->pro->all();

            if ($produto->count())
                return response()->json(['data' => $produto, 'status' => true]);
            else
                return response()->json(['data' => 'Nenhum produto cadastrado.', 'status' => false]);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['data' => 'Falha no carregamentos dos produtos.', 'status' => false]);
        }
    }

    /**
     * @param ProdutoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProdutoRequest $request)
    {
        try {
            $dados = $request->all();
            $produto = $this->pro->create($dados);

            if ($produto)
                return response()->json(['data' => $produto, 'status' => true]);
            else
                return response()->json(['data' => 'Falha no cadastro de produto.', 'status' => false]);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['data' => 'Falha no cadastro.', 'status' => false]);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        try {
            $produto = $this->pro->find($id);

            if ($produto)
                return response()->json(['data' => $produto, 'status' => true]);
            else
                return response()->json(['data' => 'O produto não foi encontrado.', 'status' => false]);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['data' => 'Falha na busca do produto..', 'status' => false]);
        }
    }

    /**
     * @param ProdutoRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProdutoRequest $request, int $id)
    {
        try {
            $produto = $this->pro->find($id);

            if ($produto) {
                $dados = $request->all();
                $atualizado = $produto->update($dados);

                if (!empty($atualizado))
                    return response()->json(['data' => $produto, 'status' => true]);
                else
                    return response()->json(['data' => 'Falha na atualização do produto', 'status' => false]);
            } else
                return response()->json(['data' => 'Falha na atualização do produto.', 'status' => false]);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['data' => 'Falha na atualização.', 'status' => false]);
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $produto  = $this->pro->find($id);
            $excluido = $produto->delete();

            if ($excluido)
                return response()->json(['data' => 'Produto excluído com sucesso.', 'status' => true]);
            else
                return response()->json(['data' => 'Falha na exclusão do produto.', 'status' => false]);

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['data' => 'Falha na exclusão.', 'status' => false]);
        }
    }
}

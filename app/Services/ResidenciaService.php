<?php

namespace App\Services;

use App\Models\Residencia;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class ResidenciaService
{

    protected $estadoService;

    public function __construct(EstadoService $estadoService) {
        $this->estadoService = $estadoService;
    }

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $residencia = Residencia::create($request);

            return $residencia;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $residencias = Residencia::all();

            if ($residencias == null) throw new FileNotFoundException('Nenhum Residencia foi encontrado.');

            return $residencias;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $residencia = Residencia::find($id);

            if ($residencia == null) throw new FileNotFoundException('o Residencia não foi encontrado.');

            return $residencia;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $residencia = Residencia::where('id', $id)->update($request);

            return $residencia;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $residencia = Residencia::findOrFail($id);
            $residencia->delete();

            return $residencia;
        });
    }

    public function getFreteData($from, $to)
    {

        // $to =  90570020  // template
        $client = new Client();

        $response = $client->request(
            'POST',
            'https://www.melhorenvio.com.br/api/v2/me/shipment/calculate',
            [
                // 'body' => '{"from":{"postal_code":"'.$from.'"},"to":{"postal_code":"'.$to.'"},"package":{"height":30,"width":20,"length":17,"weight":10.3}}',
                'body' => json_encode([
                    'from' => ['postal_code' => $from],
                    'to' => ['postal_code' => $to],
                    'package' => [
                        'height' => 30,
                        'width' => 20,
                        'length' => 17,
                        'weight' => 10.3,
                    ]
                ]),
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . env('API_TOKEN_MELHOR_ENVIO', null) . '',
                    'Content-Type' => 'application/json',
                    'User-Agent' => 'super delivery test',
                ],
            ]
        );

        // Pega os dados de entrega SEDEX
        $data = json_decode($response->getBody()->getContents(), true)[1];

        return $data;
    }

    public function calcPrecoFrete($from, $to)
    {

        try {
            // $from = Residencia::CEP_LOJA_MATRIZ;

            $client = new Client();

            $response = $client->request(
                'POST',
                'https://www.melhorenvio.com.br/api/v2/me/shipment/calculate',
                [
                    'body' => '{"from":{"postal_code":"' . $from . '"},"to":{"postal_code":"' . $to . '"},"package":{"height":30,"width":20,"length":17,"weight":10.3}}',
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . env('API_TOKEN_MELHOR_ENVIO', null) . '',
                        'Content-Type' => 'application/json',
                        'User-Agent' => 'super delivery test',
                    ],
                ]
            );

            // Pega os dados de entrega SEDEX
            $precoFrete = json_decode($response->getBody()->getContents(), true)[1]['price'];

            return $precoFrete;
        } catch (\Throwable $th) {
            throw $th;
            logger("Erro ao buscar o CEP: " . $th->getMessage());
        }
    }
    
    public function createResidenciaByUserId($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            User::findOrFail($id);
            $request['user_id'] = $id;
            $sigla = $request['uf'];

            $estado = $this->estadoService->findBySigla($sigla);
            $estadoId = $estado['id'];
            $request['estado_id'] = $estadoId;

            $residencia = Residencia::create($request);

            return $residencia;
        });
    }
    
    public function fetchResidenciaByUserId($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $residencias = Residencia::where('user_id', $id)->with('estado')->get();

            if ($residencias == null) throw new FileNotFoundException('Nenhum Residencia foi encontrado.');

            return $residencias;
        });
    }
}

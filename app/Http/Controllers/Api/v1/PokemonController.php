<?php

namespace App\Http\Controllers\Api\v1;

use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class PokemonController extends Controller
{
    public function getAllPokemon(): array
    {
        try {
            $client = new Client(['base_uri' => 'https://pokeapi.co/api/v2/']);
            $response = $client->get('pokemon/?limit=327');

            if(200 == $response->getStatusCode()) {
                $data = $response->getBody();
                $data = json_decode($data, true);
    
                $pokemon_list = $data['results'];
                $pokedex = $this->getPokemonsInfos($pokemon_list);
    
                return [
                    'success' => true,
                    'message' => __('message.welcome'),
                    'data' => $pokedex
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
    public function getPokemonsInfos($pokemon_list)
    {
        foreach ($pokemon_list as $key => $value) {
            try {
                $client = new Client();
                $response = $client->get($value['url']);

                if(200 == $response->getStatusCode()) {
                    $data = json_decode($response->getBody(), true);
                    $pokemon_list[$key]['id'] = $data['id'];
                    $pokemon_list[$key]['height'] = $data['height'];
                    $pokemon_list[$key]['weight'] = $data['weight'];
                    $pokemon_list[$key]['image'] = $data['sprites']['front_default'];
                    $pokemon_list[$key]['types'] = $data['types'];
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }

        return $pokemon_list;
    }
    public function getPokemon(int $id)
    {
        try {
            $client = new Client(['base_uri' => 'https://pokeapi.co/api/v2/']);
            $response = $client->get('pokemon/'.$id);

            if(200 == $response->getStatusCode()) {
                $data = $response->getBody();
                $data = json_decode($data, true);

                $pokemon['id'] = $data['id'];
                $pokemon['name'] = $data['name'];
                $pokemon['height'] = $data['height'];
                $pokemon['weight'] = $data['weight'];
                $pokemon['image'] = $data['sprites']['front_default'];
                $pokemon['types'] = $data['types'];
    
                return [
                    'success' => true,
                    'message' => __('message.success'),
                    'data' => $pokemon
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}

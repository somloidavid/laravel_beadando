<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = DB::table('pizzas')
            ->leftJoin('PizzaToppings', 'pizzas.id', '=', 'PizzaToppings.pizza_id')
            ->leftJoin('toppings', 'PizzaToppings.topping_id', '=', 'toppings.id')
            ->select('pizzas.*', DB::raw('GROUP_CONCAT(toppings.name) as topping_names'))
            ->groupBy('pizzas.id')
            ->get();
        return view('pizzas.index', compact('pizzas'));
    }

    public function create()
    {
        $toppings = DB::table('toppings')->get();
        return view('pizzas.create', compact('toppings'));
    }

    public function store(Request $request)
    {
        $pizzaId = DB::table('pizzas')->insertGetId([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image
        ]);

        foreach ($request->toppings as $toppingId) {
            DB::table('PizzaToppings')->insert([
                'pizza_id' => $pizzaId,
                'topping_id' => $toppingId,
            ]);
        }

        return redirect()->route('pizzas.index');
    }

    public function edit($id)
    {
        $pizza = DB::table('pizzas')->where('id', $id)->first();
        $toppings = DB::table('toppings')->get();
        $pizzaToppings = DB::table('PizzaToppings')->where('pizza_id', $id)->pluck('topping_id')->toArray();
        return view('pizzas.edit', compact('pizza', 'toppings', 'pizzaToppings'));
    }

    public function update(Request $request, $id)
    {
        DB::table('pizzas')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
        ]);

        DB::table('PizzaToppings')->where('pizza_id', $id)->delete();

        foreach ($request->toppings as $toppingId) {
            DB::table('PizzaToppings')->insert([
                'pizza_id' => $id,
                'topping_id' => $toppingId,
            ]);
        }

        return redirect()->route('pizzas.index');
    }

    public function destroy($id)
    {
        DB::table('PizzaToppings')->where('pizza_id', $id)->delete();
        DB::table('pizzas')->where('id', $id)->delete();
        return redirect()->route('pizzas.index');
    }
}

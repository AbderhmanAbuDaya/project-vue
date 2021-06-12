@extends('layouts.app')

@section('content')

    <form accept-charset="UTF-8" action="https://api.moyasar.com/v1/payments.html" method="POST">

        <input type="hidden" name="callback_url" value="{{route('home')}}" />
        <input type="hidden" name="publishable_api_key" value="pk_test_jJ96H6vEbkuGngacXXXihnh12ajFyCALzTrX4uAp" />
        <input type="hidden" name="amount" value="10000" />
        <input type="hidden" name="source[type]" value="creditcard" />
        <input type="hidden" name="description" value="Order id 1234 by guest" />

        <input type="text" name="source[name]" />
        <input type="text" name="source[number]" />
        <input type="text" name="source[month]" />
        <input type="text" name="source[year]" />
        <input type="text" name="source[cvc]" />

        <button type="submit">Purchase</button>
    </form>
    @stop

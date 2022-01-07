<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$user->name}}</title>
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}

    <style type="text/css">
        /*@import url('https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,800');*/
        @page {
            /*margin: 0px 0px 0px 0px !important;*/
            /*padding: 0px 0px 0px 0px !important;*/
            /*font-family: 'Quicksand';*/
            width: 100%;
            height: 100%;
        }
        /*@font-face {*/
        /*    font-family: 'Quicksand';*/
        /*    font-weight: normal;*/
        /*    font-style: normal;*/
        /*    font-variant: normal;*/
        /*    src: url("https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,800");*/
        /*}*/

        .typed {
            font-family: 'sans-serif';
        }
        .page-break {
            page-break-after: always;

        }
        .container{
            /*font-family: 'Quicksand';*/
        }
        .w-full{
            width: 100%;
        }
        .float-right{
            float: right;
        }
        .float-left{
            float: left;
        }
        .p-3{
            padding: 1rem;
        }
        .py-3{
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .position-absolute{
            position: absolute;
        }
        .position-relative{
            position: relative;
        }
        .top-0{
            top: 0;
        }
        .top-10{
            top: 10%;
        }
        .rgba-white-5{
            background-color: rgba(255,255,255,.8);
        }
        .left-0{
            left: 30%;
        }
        .line-height{
            line-height: 0;
        }
        .mx-auto{
            margin: 0 auto;
        }
        .text-center{
            text-align: center;
        }
        .text-green{
            color: #7f8429;
        }
        .text-orange{
            color: #f9a825;
        }
        .text-danger{
            color: #e3342f;
        }
        .text-secondary{
            color: #6c757d;
        }
        .text-blue{
            color: #007bff;
        }
        .small{
            font-size: 10px;
        }
        .text-white{
            color: white;
        }
        .bg-color-danger{
            background-color: #e3342f;
        }
        .bg-secondary{
            background-color: #6c757d;
        }
        .pt-120{
            padding-top: 50px;
        }
        .pb-50{
            padding-bottom: 50px;
        }
        .mb-50{
            margin-bottom: 50px;
        }
        .d-block{
            display: block;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }
        .table th, td {
            padding: 0.25rem;
            text-align: left;
            border: 1px solid #ccc;
        }
        .table tbody tr:nth-child(odd) {
            background: #eee;
        }

        .border-0{
            border: 0;
        }
    </style>
</head>
<body style="position: relative">
<div class="container typed">
    @foreach($paquete as $paquetes)
        <div class="position-relative w-full">
            @foreach($paquetes->imagen_paquetes->take(1) as $imagen)
                <img src="{{$imagen->nombre}}" alt="{{$paquetes->titulo}}" class="w-full">
            @endforeach

            <div class="position-absolute left-0 top-10 text-center mx-auto">
                <img src="https://gotoperu.co/images/logo-gotoperu-white.png" alt="">
                {{--        <br>--}}
                <div class="rgba-white-5 p-3 line-height">
                    <h3 class="line-height typed"><span class="text-green">Hola </span>{{$pasajero->nombre}}</h3>
                    <h4>Mi nombre es <span class="text-orange">{{$user->name}}</span></h4>
                    <h5>Soy tu asesor de viaje personal</h5>
                    <p class="small text-blue">¡Empecemos a planificar su viaje ideal!</p>
                </div>
            </div>
        </div>
        {{--        <img src="{{$paquetes->imagen}}" alt="">--}}
        {{--        <h3>{{$paquetes->titulo}}</h3>--}}
        @php
            $fecha_i = date($pasajero->fecha);
            $fecha_inquire = strtotime ( '+'.$paquetes->duracion - 1 .' day' , strtotime ( $fecha_i ) ) ;
            $fecha_inquire = date ( 'Y-m-j' , $fecha_inquire );
            $fecha_inquire = strftime("%d %B ", strtotime($fecha_inquire));
            $fecha_i = strftime("%d %B ", strtotime($fecha_i));
        @endphp

        <h1 class="text-orange">{{$paquetes->titulo}}</h1>

        <h5 class="line-height">Duración: {{$paquetes->duracion}} days</h5>
        <h5 class="line-height">Arribo: {{$fecha_i}}</h5>
        <h5 class="line-height">Partida: {{$fecha_inquire}}</h5>

        <p>{!! $paquetes->descripcion !!}</p>
        <h3 class="text-secondary">Destinos incluidos</h3>
        <ul>
        @foreach($paquete_destinos->where('idpaquetes',$paquetes->id) as $paquete_destino)
{{--            <a href="">--}}
{{--                <img src="{{$paquete_destino->destinos->imagen}}" alt="" width="50" height="50" class="rounded-circle" data-toggle="tooltip" data-placement="top" title="{{ucwords(strtolower($paquete_destino->destinos->nombre))}}">--}}
{{--            </a>--}}
                    <li>{{$paquete_destino->destinos->nombre}}</li>
        @endforeach
        </ul>
        <h2 class="text-danger">Itinerario</h2>
        @php $day = 1; $sum = 0; @endphp
        @foreach($paquetes->paquete_itinerario as $itinerario)
            @php
                $fecha = date($pasajero->fecha);
                $nuevafecha = strtotime ( '+'.$sum.' day' , strtotime ( $fecha ) ) ;
                $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                $nuevafecha = strftime("%d %B ", strtotime($nuevafecha));
            @endphp

            <h3 class=""><span class="text-white bg-color-danger py-3 small p-3">{{$nuevafecha}}:</span> {{$itinerario->itinerarios->titulo}}</h3>
            @foreach($itinerario->itinerarios->itinerario_imagen->take(1) as $imagen)
                <img src="{{$imagen->nombre}}" class="float-right" width="200">
            @endforeach
            {!! $itinerario->itinerarios->descripcion !!}
            @php $day++; $sum++; @endphp
            <div class="d-block mb-50">
        @endforeach

        <h3 class="text-secondary d-block pt-120">Incluye</h3>
        {!! $paquetes->incluye !!}

        <h3 class="text-secondary">No Incluye</h3>
        {!! $paquetes->noincluye !!}

        <h3 class="text-blue">Precio</h3>
    <p><strong class="text-green">Basado en ocupación doble / triple</strong></p>
        <table class="table m-0">
            <thead class="title-header bg-secondary text-white">
            <tr>
                <th class="text-center">2 Stars</th>
                <th class="text-center">3 Stars</th>
                <th class="text-center">4 Stars</th>
                <th class="text-center">5 Stars</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($paquetes->precio_paquetes->sortBy('estrellas') as $precio)
                    @if($precio->precio_d > 0)
                        <td class="text-center">
                            <sup>$</sup>{{$precio->precio_d}}
                        </td>
                    @else
                        <td class="text-danger text-center">
                            Inquire
                        </td>
                    @endif
                @endforeach

            </tr>
            </tbody>
        </table>

        <p><strong class="text-green">Basado en ocupación simple</strong></p>
        <table class="table m-0">
            <thead class="title-header bg-secondary text-white">
            <tr>
                <th class="text-center">2 Stars</th>
                <th class="text-center">3 Stars</th>
                <th class="text-center">4 Stars</th>
                <th class="text-center">5 Stars</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($paquetes->precio_paquetes->sortBy('estrellas') as $precio)
                    @if($precio->precio_s > 0)
                        <td class="text-center">
                            <sup>$</sup>{{$precio->precio_s}}
                        </td>
                    @else
                        <td class="text-danger text-center">
                            Inquire
                        </td>
                    @endif
                @endforeach

            </tr>
            </tbody>
        </table>
        <p class="small text-blue">* Si tiene un hotel preferido en mente, no dude en compartirlo con nosotros, ya que trabajamos con la mayoría de los hoteles en Perú.</p>

    <table class="border-0">
        <tr class="border-0">
            <td class="border-0"><img src="{{$user->imagen}}" alt="" width="200"></td>
            <td class="border-0">
                <p class="line-height">{{$user->name}}</p>
                <p class="line-height small text-secondary">Travel Advisor</p>
                <p>{{$user->email}}</p>
                <a href="https://api.whatsapp.com/send?phone=51960680005" target="_blank">Whatsapp: +51 960 680 005</a>
            </td>
        </tr>
    </table>

        <div class="text-center text-secondary small pt-120">
            Grupo <a href="https://gotoperu.co/" target="_blank">GOTOPERU</a> 2022
        </div>


    @endforeach
</div>
</body>
</html>

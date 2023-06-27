<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @php
        $cpt =1;  
        $type = ""; 
        $salaire = 0;
        $gain = 0;
        $retenu = 0;
        $sommeRetenu= 0;
        $sommeGain= 0;
        $ret = "";
        $win = "";
        $salaire = 0;
        $base = $paies->taux_configuration->montant*$paies->jours_presents;
    @endphp
    <div class="container">
        <div class="d-flex justify-content-end" style="text-align: right;">Mois de : {{Carbon\Carbon::now()->format('F - Y')}}</div>
        <h1 class="text-center" style="text-align: center;">{{ strtoupper("Fiche de paie N° $status")}}</h1>
        <section>
            <p>Nom complet : <span style="font-weight: bold;">{{$paies->user->name}}</span> </p>
            <p>Fonction : <span style="font-weight: bold; ">Test</span></p>
            <p>Département : <span style="font-weight: bold; ">Test</span></p>
            <p>Direction : <span style="font-weight: bold;">Test</span></p>
            <p>Service : <span style="font-weight: bold;">Test</span></p>
            <p>Nombre de jours de prestation : <span style="font-weight: bold;">{{$paies->jours_presents}}</span></p>
            <p>Montant du salaire de base : <span style="font-weight: bold; font-style: italic;">{{$paies->taux_configuration->montant .' '. $paies->taux_configuration->devise}}</span></p>
        </section>
        <section>
            <table style="border-collapse: collapse; border-spacing: 0; width: 100%;text-align: center;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black;">Rubriques</th>
                        <th style="border: 1px solid black;">Taux</th>
                        <th style="border: 1px solid black;">Gains</th>
                        <th style="border: 1px solid black;">Retenus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="border: 1px solid black;">Salaire brut</td>
                        <td style="border: 1px solid black;">-</td>
                        <td style="border: 1px solid black;">{{$base}}</td>
                        <td style="border: 1px solid black;">-</td>
                    </tr>
                    @forelse($fiches as $fiche)
                        <tr>
                            <td style="border: 1px solid black;"> {{$fiche->rubrique}} </td>
                            <td style="border: 1px solid black;"> {{$fiche->valeur .' '.$fiche->unite}} </td>
                            @php
                                if($fiche->mouvement == 'GAIN'){
                                    if($fiche->unite != "%"){
                                        $gain = $gain + $fiche->valeur;
                                    }else{
                                        $gain = $gain + ($base*$fiche->valeur/100);
                                    }
                                    echo "<td style='border: 1px solid black'>$gain</td>
                                        <td style='border: 1px solid black;''>-</td>
                                    ";
                                    $sommeGain = $sommeGain + $gain;
                                }
                                if($fiche->mouvement == 'RETENU'){
                                    if($fiche->unite != "%"){
                                        $retenu = $retenu + $fiche->valeur;
                                    }else{
                                        $retenu = $retenu + ($base*$fiche->valeur/100);
                                    }
                                    
                                    echo "<td style='border: 1px solid black'>-</td>
                                        <td style='border: 1px solid black;''>$retenu</td>
                                    ";
                                    $sommeRetenu = $sommeRetenu + $retenu;
                                }
                                
                            @endphp
                            
                        </tr>
                    @empty
                    @endforelse
                    @php
                        $salaire = $base + $sommeGain - $sommeRetenu;
                    @endphp
                    <tr>
                        <td style="border: 1px solid black;">Totaux </td>
                        <td style="border: 1px solid black;">-</td>
                        <td style="border: 1px solid black;">{{($base + $sommeGain) .' '.$paies->taux_configuration->devise}}</td>
                        <td style="border: 1px solid black;">{{$sommeRetenu .' '.$paies->taux_configuration->devise}}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr style="font-weight: bold;">
                        <td style="border: 1px solid black;">Salaire Net </td>
                        <td style="border: 1px solid black;">-</td>
                        <td style="border: 1px solid black;">{{$salaire .' '.$paies->taux_configuration->devise}}</td>
                        <td style="border: 1px solid black;"></td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </div>
</body>
</html>
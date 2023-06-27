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
        $cpt = 1;
    @endphp
    <div class="container">
        <div class="d-flex justify-content-end" style="text-align: right;">{{Carbon\Carbon::now()->format('d/m/Y H:i:s')}}</div>
        <h1 class="text-center" style="text-align: center;">{{ strtoupper("Liste des agents $status")}}</h1>
        <table style="border-collapse: collapse; border-spacing: 0; width: 100%;text-align: center;">
            <thead>
                <tr>
                    <th style="border: 1px solid black;">N°</th>
                    <th style="border: 1px solid black;">Agent</th>
                    <th style="border: 1px solid black;">Nombre des jours</th>
                    <th style="border: 1px solid black;">Montant de base</th>
                    <th style="border: 1px solid black;">Salaire Mensuel</th>
                    <th style="border: 1px solid black;">Dévise</th>
                </tr>
            </thead>
            <tbody class="text" style="text-align: center;">
                @forelse ($paies as $paie) 
                <tr>
                    <td style="border: 1px solid black;">{{ $cpt++ }}</td>
                    <td style="border: 1px solid black;">{{ strtoupper($paie->user->name) }}</td>
                    <td style="border: 1px solid black;">{{ $paie->jours_presents }}</td>
                    <td style="border: 1px solid black;">{{ $paie->taux_configuration->montant .' '. $paie->taux_configuration->devise }}</td>
                    <td style="border: 1px solid black;">{{ $paie->taux_configuration->montant*$paie->jours_presents }}</td>
                    <td style="border: 1px solid black;">{{ ($paie->taux_configuration->devise) }}</td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5"> 
                            Aucune agent disponible pour cette partie
                        </td>
                    </tr>
                @endforelse
            </tbody>
            
        </table>
    </div>
</body>
</html>
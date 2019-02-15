<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext"
          rel="stylesheet">
    <style>
        body, table, h1, h2, h3, h4, h5, h6, p, td, th, a {
            font-family: 'Lato', Arial, Helvetica, sans-serif;
            line-height: 1.3;
        }

        .wrapper {
            margin: 0 -20px 0;
            padding: 0 15px;
        }

        .middle {
            text-align: center;
        }

        .title {
            font-size: 35px;
        }

        .pb-10 {
            padding-bottom: 10px;
        }

        .pb-5 {
            padding-bottom: 5px;
        }

        .head-content {
            padding-bottom: 4px;
            border-style: none none ridge none;
            font-size: 18px;
        }

        table, table.table {
            font-size: 14px;
            border-collapse: collapse;
        }

        .page-break {
            page-break-after: always;
            page-break-inside: avoid;
        }

        tr.even {
            /*background-color: #eff0f1;*/
        }

        table td.left,
        table th.left {
            text-align: left !important;
        }

        table td.right,
        table th.right {
            text-align: right !important;
        }

        table .bold {
            font-weight: 600;
        }

        .bg-black {
            background-color: #000 !important;
        }

        .f-white {
            color: #fff !important;
        }

        .content:not(:last-child),
        .table:not(:last-child),
        .table-container:not(:last-child),
        .title:not(:last-child) {
            margin-bottom: 1.5rem;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        td,
        th {
            padding: 0;
            text-align: left;
        }

        table td,
        table th {
            text-align: left;
            vertical-align: top;
        }

        table th {
            color: #363636;
        }

        .content table {
            width: 100%;
        }

        .content table td,
        .content table th {
            border: 1px solid #dbdbdb;
            border-width: 0 0 1px;
            padding: 0.5em 0.75em;
            vertical-align: top;
        }

        .content table th {
            color: #363636;
            text-align: left;
        }

        .content table thead td,
        .content table thead th {
            border-width: 0 0 2px;
            color: #363636;
        }

        .content table tfoot td,
        .content table tfoot th {
            border-width: 2px 0 0;
            color: #363636;
        }

        .content table tbody tr:last-child td,
        .content table tbody tr:last-child th {
            border-bottom-width: 0;
        }

        .table {
            background-color: white;
            color: #363636;
        }

        .table td,
        .table th {
            border: 1px solid #dbdbdb;
            border-width: 0 0 1px;
            padding: 0.5em 0.75em;
            vertical-align: top;
        }

        .table td.is-white,
        .table th.is-white {
            background-color: white;
            border-color: white;
            color: #0a0a0a;
        }

        .table td.is-black,
        .table th.is-black {
            background-color: #0a0a0a;
            border-color: #0a0a0a;
            color: white;
        }

        .table td.is-light,
        .table th.is-light {
            background-color: whitesmoke;
            border-color: whitesmoke;
            color: #363636;
        }

        .table td.is-dark,
        .table th.is-dark {
            background-color: #363636;
            border-color: #363636;
            color: whitesmoke;
        }

        .table td.is-primary,
        .table th.is-primary {
            background-color: #00d1b2;
            border-color: #00d1b2;
            color: #fff;
        }

        .table td.is-link,
        .table th.is-link {
            background-color: #3273dc;
            border-color: #3273dc;
            color: #fff;
        }

        .table td.is-info,
        .table th.is-info {
            background-color: #209cee;
            border-color: #209cee;
            color: #fff;
        }

        .table td.is-success,
        .table th.is-success {
            background-color: #23d160;
            border-color: #23d160;
            color: #fff;
        }

        .table td.is-warning,
        .table th.is-warning {
            background-color: #ffdd57;
            border-color: #ffdd57;
            color: rgba(0, 0, 0, 0.7);
        }

        .table td.is-danger,
        .table th.is-danger {
            background-color: #e50800;
            border-color: #e50800;
            color: #fff;
        }

        .table td.is-narrow,
        .table th.is-narrow {
            white-space: nowrap;
            width: 1%;
        }

        .table td.is-selected,
        .table th.is-selected {
            background-color: #00d1b2;
            color: #fff;
        }

        .table td.is-selected a,
        .table td.is-selected strong,
        .table th.is-selected a,
        .table th.is-selected strong {
            color: currentColor;
        }

        .table th {
            color: #363636;
            text-align: left;
        }

        .table tr.is-selected {
            background-color: #00d1b2;
            color: #fff;
        }

        .table tr.is-selected a,
        .table tr.is-selected strong {
            color: currentColor;
        }

        .table tr.is-selected td,
        .table tr.is-selected th {
            border-color: #fff;
            color: currentColor;
        }

        .table thead td,
        .table thead th {
            border-width: 0 0 2px;
            color: #363636;
        }

        .table tfoot td,
        .table tfoot th {
            border-width: 2px 0 0;
            color: #363636;
        }

        .table tbody tr:last-child td,
        .table tbody tr:last-child th {
            border-bottom-width: 0;
        }

        .table.is-bordered td,
        .table.is-bordered th {
            border-width: 1px;
        }

        .table.is-bordered tr:last-child td,
        .table.is-bordered tr:last-child th {
            border-bottom-width: 1px;
        }

        .table.is-fullwidth {
            width: 100%;
        }

        .table.is-hoverable tbody tr:not(.is-selected):hover {
            background-color: #fafafa;
        }

        .table.is-hoverable.is-striped tbody tr:not(.is-selected):hover {
            background-color: whitesmoke;
        }

        .table.is-narrow td,
        .table.is-narrow th {
            padding: 0.25em 0.5em;
        }

        .table.is-striped tbody tr:not(.is-selected):nth-child(even) {
            background-color: #fafafa;
        }

        .table-container {
            -webkit-overflow-scrolling: touch;
            overflow: auto;
            overflow-y: hidden;
            max-width: 100%;
        }

        .table tr.page {
            page-break-after: always !important;
            page-break-inside: avoid !important;
        }

        @foreach ($styles as $style)
        {{ $style['selector'] }}






        {
        {{ $style['style'] }}







        }
        @endforeach
    </style>
</head>
<body>
<?php
$ctr = 1;
$no = 1;
$currentGroupByData = [];
$total = [];
$isOnSameGroup = true;
$grandTotalSkip = 1;

foreach ($showTotalColumns as $column => $type) {
    $total[$column] = 0;
    $total[$column.'Geral'] = 0;
}

if ($showTotalColumns != []) {
    foreach ($columns as $colName => $colData) {
        if (!array_key_exists($colName, $showTotalColumns)) {
            $grandTotalSkip++;
        } else {
            break;
        }
    }
}
?>
<div class="wrapper">
    <div class="pb-5">
        <img src="{{asset('images/logo_dicave.png')}}" style="text-align: left; width: 8em; margin-bottom: -30px;">
        <div class="middle pb-10 title">
            {{ $headers['title'] }}
        </div>
        @if ($showMeta)
            <div class="head-content">
                <table style="font-size: 16px;" cellpadding="0" cellspacing="0" width="100%" border="0">
                    <?php $metaCtr = 0; ?>
                    @foreach($headers['meta'] as $name => $value)
                        @if ($metaCtr % 2 == 0)
                            <tr>
                                @endif
                                <td><span style="color:#808080;">{{ $name }}:</span> {{ ($value) }}</td>
                                @if ($metaCtr % 2 == 1)
                            </tr>
                        @endif
                        <?php $metaCtr++; ?>
                    @endforeach
                </table>
            </div>
        @endif
    </div>
    <div class="content">
        <table width="100%" class="table is-narrow is-striped">
            @if ($showHeader && count($groupByArr) <= 0)
                <thead>
                <tr>
                    @if ($showNumColumn)
                        <th class="left">#</th>
                    @endif
                    @foreach ($columns as $colName => $colData)
                        @if(!in_array($colName, $groupByArr))
                            @if (array_key_exists($colName, $editColumns))
                                <th style=""
                                    class="{{ isset($editColumns[$colName]['class']) ? $editColumns[$colName]['class'] : 'left' }}">{{ $colName }}</th>
                            @else
                                <th class="left">{{ $colName }}</th>
                            @endif
                        @endif
                    @endforeach
                </tr>
                </thead>
            @endif
            <?php
            $chunkRecordCount = ($limit == null || $limit > 50000) ? 50000 : $limit + 1;
            $__env = isset($__env) ? $__env : null;
            $query->chunk($chunkRecordCount, function($results) use (
                &$ctr,
                &$no,
                &$total,
                &$currentGroupByData,
                &$isOnSameGroup,
                $grandTotalSkip,
                $columns,
                $limit,
                $editColumns,
                $showTotalColumns,
                $groupByArr,
                $applyFlush,
                $showNumColumn,
                $__env,
                $showHeader
            ) {
            $firstOnSameGroup = true;
            ?>
            @foreach($results as $result)
                <?php
                //if ($limit != null && $ctr == $limit + 1) return false;
                if ($groupByArr) {
                $isOnSameGroup = true;

                foreach ($groupByArr as $groupBy) {
                    if (is_object($columns[$groupBy]) && $columns[$groupBy] instanceof Closure) {
                        $thisGroupByData[$groupBy] = $columns[$groupBy]($result);
                    } else {
                        $thisGroupByData[$groupBy] = $result->{$columns[$groupBy]};
                    }

                    if (isset($currentGroupByData[$groupBy])) {
                        if ($thisGroupByData[$groupBy] != $currentGroupByData[$groupBy]) {
                            $isOnSameGroup = false;
                            $firstOnSameGroup = true;
                        }
                    }

                    $currentGroupByData[$groupBy] = $thisGroupByData[$groupBy];
                }

                if ($isOnSameGroup === false) {
                    $span = $grandTotalSkip - count($groupByArr);
                    if (!$showNumColumn) {
                        $span = $span - 1;
                    }

                    if ($showTotalColumns != [] && $ctr > 1) {
                        echo '<tr >
                                            <td class="is-dark" colspan="' . $span . '"><b>Total</b></td>';
                        $dataFound = false;
                        foreach ($columns as $colName => $colData) {
                            if (array_key_exists($colName, $showTotalColumns)) {
                                if ($showTotalColumns[$colName] == 'point') {
                                    echo '<td class="is-dark right"><b>' . number_format($total[$colName], 2, ',',
                                            '.') . '</b></td>';
                                } else {
                                    echo '<td class="is-dark right"><b>' . strtoupper($showTotalColumns[$colName]) . ' ' . number_format($total[$colName],
                                            2, ',', '.') . '</b></td>';
                                }
                                $dataFound = true;
                            } else {
                                if ($dataFound && !in_array($colName, $groupByArr)) {
                                    echo '<td class="is-dark"></td>';
                                }
                            }
                        }
                        echo '</tr>';//<tr style="height: 10px;"><td colspan="99">&nbsp;</td></tr>';
                    }
                    echo '<tr style="height: 5px;"><td style="background-color: white; min-height: 40px; border: 0 transparent;" colspan="99">&nbsp;</td></tr>';
                    // echo '<tr><td style="background-color: white; min-height: 40px; border: 0 transparent;" colspan="'.$grandTotalSkip.'"><br/></td></tr>';

                    // Reset No, Reset Total
                    $no = 1;
                    foreach ($showTotalColumns as $showTotalColumn => $type) {
                        //$total[$showTotalColumn.'Geral'] += $total[$showTotalColumn];
                        $total[$showTotalColumn] = 0;
                    }
                    $isOnSameGroup = true;
                }

                if($firstOnSameGroup){
                foreach ($groupByArr as $groupBy){
                $colName = collect($columns)->mapWithKeys(function ($val, $key) {
                    return [$key => $key];
                });
                $colData = $columns[$groupBy];

                $class = 'left';
                // Check Edit Column to manipulate class & Data
                if (is_object($colData) && $colData instanceof Closure) {
                    $generatedColData = $colData($result);
                } else {
                    $generatedColData = $result->{$colData};
                }
                $displayedColValue = $generatedColData;
                if (array_key_exists($groupBy, $editColumns)) {
                    if (isset($editColumns[$groupBy]['class'])) {
                        $class = $editColumns[$groupBy]['class'];
                    }

                    if (isset($editColumns[$groupBy]['displayAs'])) {
                        $displayAs = $editColumns[$groupBy]['displayAs'];
                        if (is_object($displayAs) && $displayAs instanceof Closure) {
                            $displayedColValue = $displayAs($result);
                        } elseif (!(is_object($displayAs) && $displayAs instanceof Closure)) {
                            $displayedColValue = $displayAs;
                        }
                    }
                }

                if (array_key_exists($groupBy, $showTotalColumns)) {
                    $total[$groupBy] += $generatedColData;
                }
                $span = (count($columns) + 0);
                if (!$showNumColumn) {
                    $span = $span - 1;
                }
                $tcl = $ctr % 10 == 0 ? '' : '';
                echo "<tr class='$tcl'>
		    						<td class=\"is-light {$class}\" colspan=\"{$span}\"><b>{$colName[$groupBy]}:</b> {$displayedColValue}</td>
		    					  </tr>";
                ?>
                @if ($showHeader && count($groupByArr) > 0)
                    <tr class="{{$tcl}}">
                        @if ($showNumColumn)
                            <th class="left">#</th>
                        @endif
                        @foreach ($columns as $colName => $colData)
                            @if(!in_array($colName, $groupByArr))
                                @if (array_key_exists($colName, $editColumns))
                                    <th style=""
                                        class="{{ isset($editColumns[$colName]['class']) ? $editColumns[$colName]['class'] : 'left' }}">{{ $colName }}</th>
                                @else
                                    <th class="left">{{ $colName }}</th>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                @endif
                <?php

                }
                $firstOnSameGroup = false;
                }

                }
                ?>
                <tr align="center" class="{{ ($no % 2 == 0) ? 'even' : 'odd' }}">
                    @if ($showNumColumn)
                        <td class="left">{{ $no }}</td>
                    @endif
                    @foreach ($columns as $colName => $colData)
                        <?php
                        $class = 'left';
                        // Check Edit Column to manipulate class & Data
                        if (is_object($colData) && $colData instanceof Closure) {
                            $generatedColData = $colData($result);
                        } else {
                            $generatedColData = $result->{$colData};
                        }
                        $displayedColValue = $generatedColData;
                        if (array_key_exists($colName, $editColumns)) {
                            if (isset($editColumns[$colName]['class'])) {
                                $class = $editColumns[$colName]['class'];
                            }

                            if (isset($editColumns[$colName]['displayAs'])) {
                                $displayAs = $editColumns[$colName]['displayAs'];
                                if (is_object($displayAs) && $displayAs instanceof Closure) {
                                    $displayedColValue = $displayAs($result);
                                } elseif (!(is_object($displayAs) && $displayAs instanceof Closure)) {
                                    $displayedColValue = $displayAs;
                                }
                            }
                        }

                        if (array_key_exists($colName, $showTotalColumns)) {
                            $total[$colName] += $generatedColData;
                            $total[$colName.'Geral'] += $generatedColData;
                        }
                        ?>
                        @if(!in_array($colName, $groupByArr))
                            <td style="" class="{{ $class }}">{!!  $displayedColValue !!}</td>
                        @endif
                    @endforeach
                </tr>
                <?php $ctr++; $no++; ?>
            @endforeach
            <?php
            if ($applyFlush) flush();
            });
            ?>
            @if ($showTotalColumns != [] && $ctr > 1)
                @php
                    $span = $grandTotalSkip - count($groupByArr);
                    if(!$showNumColumn){
                        $span = $span - 1;
                    }
                @endphp
                <tr class="">
                    <td class="is-dark" colspan="{{ $span}}"><b>Total</b></td> {{-- For Number --}}
                    <?php $dataFound = false; ?>
                    @foreach ($columns as $colName => $colData)
                        @if (array_key_exists($colName, $showTotalColumns))
                            <?php $dataFound = true; ?>
                            @if ($showTotalColumns[$colName] == 'point')
                                <td style="" class="is-dark right">
                                    <b>{{ number_format($total[$colName], 2, ',', '.') }}</b></td>
                            @else
                                <td style="" class="is-dark right">
                                    <b>{{ strtoupper($showTotalColumns[$colName]) }} {{ number_format($total[$colName], 2, ',', '.') }}</b>
                                </td>
                            @endif
                        @else
                            @if(!in_array($colName, $groupByArr))
                                @if ($dataFound)
                                    <td class="is-dark" style=""></td>
                                @endif
                            @endif
                        @endif
                    @endforeach
                </tr>
                @if(count($groupByArr) > 0)
                    <tr class="">
                        <td class="is-dark" colspan="{{ $span}}"><b>Total Geral</b></td> {{-- For Number --}}
                        <?php $dataFound = false; ?>
                        @foreach ($columns as $colName => $colData)
                            @if (array_key_exists($colName, $showTotalColumns))
                                <?php $dataFound = true; ?>
                                @if ($showTotalColumns[$colName] == 'point')
                                    <td style="" class="is-dark right">
                                        <b>{{ number_format($total[$colName.'Geral'], 2, ',', '.') }}</b></td>
                                @else
                                    <td style="" class="is-dark right">
                                        <b>{{ strtoupper($showTotalColumns[$colName]) }} {{ number_format($total[$colName.'Geral'], 2, ',', '.') }}</b>
                                    </td>
                                @endif
                            @else
                                @if(!in_array($colName, $groupByArr))
                                    @if ($dataFound)
                                        <td class="is-dark" style=""></td>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </tr>
                @endif
            @endif
        </table>
    </div>
</div>
</body>
</html>

<?php

namespace Project\Classes;

class calc_scale
{
    public function calc_cat($num, $cat)
    {

        $RB[] = [
            'array_1' => ['range' => range(0, 3), 'norm' => 4, 'mini' => 2],
            'array_2' => ['range' => range(4, 6), 'norm' => 5, 'mini' => 3],
            'array_3' => ['range' => range(7, 9), 'norm' => 6, 'mini' => 9],
            'array_4' => ['range' => range(10, 13), 'norm' => 7, 'mini' => 16],
            'array_5' => ['range' => range(14, 16), 'norm' => 8, 'mini' => 25],
            'array_6' => ['range' => range(17, 19), 'norm' => 9, 'mini' => 37],
            'array_7' => ['range' => range(20, 22), 'norm' => 10, 'mini' => 50],
            'array_8' => ['range' => range(23, 26), 'norm' => 11, 'mini' => 63],
            'array_9' => ['range' => range(27, 29), 'norm' => 12, 'mini' => 75],
            'array_10' => ['range' => range(30, 32), 'norm' => 13, 'mini' => 84],
            'array_11' => ['range' => range(33, 36), 'norm' => 14, 'mini' => 91],
            'array_12' => ['range' => range(37, 39), 'norm' => 15, 'mini' => 95]
        ];

        $SI[] = [
            'array_1' => ['range' => range(0, 0), 'norm' => 3, 'mini' => 1],
            'array_2' => ['range' => range(1, 4), 'norm' => 4, 'mini' => 2],
            'array_3' => ['range' => range(5, 8), 'norm' => 5, 'mini' => 3],
            'array_4' => ['range' => range(9, 12), 'norm' => 6, 'mini' => 9],
            'array_5' => ['range' => range(13, 15), 'norm' => 7, 'mini' => 16],
            'array_6' => ['range' => range(16, 19), 'norm' => 8, 'mini' => 25],
            'array_7' => ['range' => range(20, 23), 'norm' => 9, 'mini' => 37],
            'array_8' => ['range' => range(24, 27), 'norm' => 10, 'mini' => 50],
            'array_9' => ['range' => range(28, 30), 'norm' => 11, 'mini' => 63],
            'array_10' => ['range' => range(31, 34), 'norm' => 12, 'mini' => 75],
            'array_11' => ['range' => range(35, 38), 'norm' => 13, 'mini' => 84],
            'array_12' => ['range' => range(39, 342), 'norm' => 14, 'mini' => 91]
        ];

        $SC[] = [
            'array_1' => ['range' => range(0, 1), 'norm' => 2, 'mini' => "<1"],
            'array_2' => ['range' => range(2, 4), 'norm' => 3, 'mini' => 1],
            'array_3' => ['range' => range(5, 8), 'norm' => 4, 'mini' => 2],
            'array_4' => ['range' => range(9, 11), 'norm' => 5, 'mini' => 3],
            'array_5' => ['range' => range(12, 13), 'norm' => 6, 'mini' => 9],
            'array_6' => ['range' => range(14, 16), 'norm' => 7, 'mini' => 16],
            'array_7' => ['range' => range(17, 18), 'norm' => 8, 'mini' => 25],
            'array_8' => ['range' => range(19, 21), 'norm' => 9, 'mini' => 37],
            'array_9' => ['range' => range(22, 23), 'norm' => 10, 'mini' => 50],
            'array_10' => ['range' => range(24, 25), 'norm' => 11, 'mini' => 63],
            'array_11' => ['range' => range(26, 27), 'norm' => 12, 'mini' => 75],
        ];

        $ER[] = [
            'array_1' => ['range' => range(0, 1), 'norm' => 3, 'mini' => 1],
            'array_2' => ['range' => range(2, 4), 'norm' => 4, 'mini' => 2],
            'array_3' => ['range' => range(5, 6), 'norm' => 5, 'mini' => 3],
            'array_4' => ['range' => range(7, 8), 'norm' => 6, 'mini' => 9],
            'array_5' => ['range' => range(9, 10), 'norm' => 7, 'mini' => 16],
            'array_6' => ['range' => range(11, 12), 'norm' => 8, 'mini' => 25],
            'array_7' => ['range' => range(13, 14), 'norm' => 9, 'mini' => 37],
            'array_8' => ['range' => range(15, 16), 'norm' => 10, 'mini' => 50],
            'array_9' => ['range' => range(17, 18), 'norm' => 11, 'mini' => 63],
            'array_10' => ['range' => range(19, 20), 'norm' => 12, 'mini' => 75],
            'array_11' => ['range' => range(21, 22), 'norm' => 13, 'mini' => 84],
            'array_12' => ['range' => range(23, 24), 'norm' => 14, 'mini' => 91],
        ];

        $CS[] = [
            'array_1' => ['range' => range(0, 0), 'norm' => 5, 'mini' => 3],
            'array_2' => ['range' => range(1, 1), 'norm' => 6, 'mini' => 9],
            'array_3' => ['range' => range(2, 3), 'norm' => 7, 'mini' => 16],
            'array_4' => ['range' => range(4, 6), 'norm' => 8, 'mini' => 25],
            'array_5' => ['range' => range(7, 8), 'norm' => 9, 'mini' => 37],
            'array_6' => ['range' => range(9, 10), 'norm' => 10, 'mini' => 50],
            'array_7' => ['range' => range(11, 13), 'norm' => 11, 'mini' => 63],
            'array_8' => ['range' => range(14, 15), 'norm' => 12, 'mini' => 75],
            'array_9' => ['range' => range(16, 17), 'norm' => 13, 'mini' => 84],
            'array_10' => ['range' => range(18, 19), 'norm' => 14, 'mini' => 91],
            'array_11' => ['range' => range(20, 21), 'norm' => 15, 'mini' => 95],
        ];

        $MS[] = [
            'array_1' => ['range' => range(0, 0), 'norm' => 5, 'mini' => 3],
            'array_2' => ['range' => range(1, 2), 'norm' => 6, 'mini' => 9],
            'array_3' => ['range' => range(3, 4), 'norm' => 7, 'mini' => 16],
            'array_4' => ['range' => range(5, 5), 'norm' => 8, 'mini' => 25],
            'array_5' => ['range' => range(6, 7), 'norm' => 9, 'mini' => 37],
            'array_6' => ['range' => range(8, 9), 'norm' => 10, 'mini' => 50],
            'array_7' => ['range' => range(10, 11), 'norm' => 11, 'mini' => 63],
            'array_8' => ['range' => range(12, 13), 'norm' => 12, 'mini' => 75],
            'array_9' => ['range' => range(14, 15), 'norm' => 13, 'mini' => 84],
            'array_10' => ['range' => range(16, 16), 'norm' => 14, 'mini' => 91],
            'array_11' => ['range' => range(17, 18), 'norm' => 15, 'mini' => 95],
            'array_12' => ['range' => range(19, 20), 'norm' => 16, 'mini' => 98],
            'array_13' => ['range' => range(21, 21), 'norm' => 17, 'mini' => 99],
        ];

        switch ($cat) {
            case 'RB':
                $cat = $RB;
                break;
            case 'SI':
                $cat = $SI;
                break;
            case 'SC':
                $cat = $SC;
                break;
            case 'ER':
                $cat = $ER;
                break;
            case 'CS':
                $cat = $CS;
                break;
            case 'MS':
                $cat = $MS;
                break;
            default:
                return false;
                break;
        }

        foreach ($cat as $value) {
            foreach ($value as $one_value) {
                if (in_array($num, $one_value['range'])) {
                    $norm =  $one_value['norm'];
                    $mini =  $one_value['mini'];
                    return $norm;
                }
            }
        }
    }

    public function calc_all($RB, $SI, $SC, $ER, $CS, $MS)
    {
        $autism_degree = array_merge([43, 44], [46, 47], [49, 50], [52, 53], [55, 56], [58, 59], range(61, 63), [65, 66], [68, 69], [71, 72], [74, 75], [77, 78], [80, 81], [83, 84], [86, 87], [89, 90], [92, 93, 94], [96, 97], [99, 100], [102, 103], [105, 106], [108, 109], [111, 112], [114, 115], [117, 118], range(120, 122),  [124, 125], [127, 128], [130, 131], [133, 134], [136, 137], [139, 140]);
        $result = range(21, 87);
        $norm = [$RB, $SI, $SC, $ER, $CS, $MS];
        $norm_sum = array_sum($norm);
        foreach ($result as $key => $value) {
            if ($value == $norm_sum) {
                return $autism_degree[$key];
            }
        }
    }
}
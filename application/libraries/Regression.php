<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regression {

    private function matrixInverse($matrix) {
        $n = count($matrix);
        $identity = [];
        for ($i = 0; $i < $n; $i++) {
            $identity[$i] = array_fill(0, $n, 0);
            $identity[$i][$i] = 1;
        }
        for ($i = 0; $i < $n; $i++) {
            $factor = $matrix[$i][$i];
            for ($j = 0; $j < $n; $j++) {
                $matrix[$i][$j] /= $factor;
                $identity[$i][$j] /= $factor;
            }
            for ($k = 0; $k < $n; $k++) {
                if ($k != $i) {
                    $factor = $matrix[$k][$i];
                    for ($j = 0; $j < $n; $j++) {
                        $matrix[$k][$j] -= $matrix[$i][$j] * $factor;
                        $identity[$k][$j] -= $identity[$i][$j] * $factor;
                    }
                }
            }
        }
        return $identity;
    }

    private function matrixMultiply($a, $b) {
        $result = [];
        for ($i = 0; $i < count($a); $i++) {
            for ($j = 0; $j < count($b[0]); $j++) {
                $result[$i][$j] = 0;
                for ($k = 0; $k < count($b); $k++) {
                    $result[$i][$j] += $a[$i][$k] * $b[$k][$j];
                }
            }
        }
        return $result;
    }

    private function transpose($matrix) {
        $transposed = [];
        for ($i = 0; $i < count($matrix[0]); $i++) {
            $transposed[$i] = array_column($matrix, $i);
        }
        return $transposed;
    }

    public function trainAndSave($x, $y, $filename) {
        // $x = [[1,2],[1,3]]
        // $y = [[5],[3]]
        $X = [];
        foreach ($x as $row) {
            $X[] = array_merge([1], $row);
        }
        $X_T = $this->transpose($X);

        $X_T_X = $this->matrixMultiply($X_T, $X);
        $X_T_X_inv = $this->matrixInverse($X_T_X);
        $X_T_y = $this->matrixMultiply($X_T, $y);
        $coefficients = $this->matrixMultiply($X_T_X_inv, $X_T_y);

        file_put_contents($filename, serialize($coefficients));

        return $coefficients;
    }

    public function loadCoefficients($filename) {
        if (!file_exists($filename)) {
            throw new Exception("Le fichier n'existe pas.");
        }
        $serializedData = file_get_contents($filename);
        return unserialize($serializedData);
    }

    public function predict($x, $coefficients) {
        $result = $coefficients[0][0];
        for ($i = 0; $i < count($x); $i++) {
            $result += $coefficients[$i + 1][0] * $x[$i];
        }
        return $result;
    }
}

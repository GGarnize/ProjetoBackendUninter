<?php

namespace App\Http\Controllers;

class Controller
{
    public function aluno() {
        $aluno = new \stdClass();
        $aluno->nome = 'Guilherme de Oliveira Garnize';
        $aluno->RA = 4579677;
        $aluno->escola = 'Uninter';
        $aluno->curso = 'CST ANÁLISE E DESENVOLVIMENTO DE SISTEMAS';
        $aluno->modalidade = 'DISTÂNCIA';
        $aluno->disciplina = 'Projeto: Desenvolvimento Back-end (797849)';
        $aluno->professor = 'Winston Sen Lun Fung, Me.';
        $aluno->fase = 'C Fase I 2025 - Regular -- UTA DESENVOLVIMENTO AVANÇADO';
        $aluno->polo = 'Polo Santa Cruz do Sul - RS';
        return $aluno;
    }
}

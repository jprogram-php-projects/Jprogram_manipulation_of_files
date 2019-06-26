<?php
	class Comentarios{
		private $nome, $email, $texto, $data, $hora;

		public function __construct($dados){
			$this->nome = $dados['nome'];
			$this->email = $dados['email'];
			$this->texto = $dados['msg'];

			$this->data = $this->obterData();
			$this->hora = $this->obterHora();

			$this->salvarComentario();
		}

		private function criarArquivo(){
			$nome_arquivo = $this->nome.".txt";
			$arquivo = fopen($nome_arquivo, 'a');
			return $arquivo;
		}

		private function salvarComentario(){

			echo "Comentario Salvo";

			$conteudo = "Nome: ". $this->nome. "\r\n".
					"Email: ". $this->email. "\r\n".
					"Comentario: ". $this->texto. "\r\n".
					"Data: ". $this->data. " - ". $this->hora
			;

			fwrite($this->criarArquivo(), $conteudo);

			fclose($this->criarArquivo());
		}

		private function obterData(){
			$dia = date("d");
			$mes = date("m");
			$ano = date("Y");

			$meses = Array(
				"Janeiro", "Fevereiro","Março","Abril","Maio","Junho",
				"Julho","Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
			);

			return $dia. " de ". $meses[$mes-1]. " de ". $ano;
		}

		private function obterHora(){
			$hora = date("H"); //h: 12 horas | H: 24 horas
			$minuto = date("i");
			$segundo = date("s");

			return $hora.":".$minuto.":".$segundo;
		}
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$comentario = new Comentarios($_POST);
	}
?>
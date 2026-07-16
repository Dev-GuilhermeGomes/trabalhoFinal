@extends('layouts.app')


@section('title')

404 - Página não encontrada

@endsection



@section('content')

<section class="error-page">
	<div class="error-page__badge">Erro 404</div>

	<h1>Página não encontrada</h1>

	<p>
		O endereço que tentaste abrir não existe, foi movido ou está temporariamente indisponível.
	</p>

	<div class="error-page__actions">
		<a href="{{ url('/') }}" class="error-page__button error-page__button--primary">Voltar à página inicial</a>
		<a href="{{ route('studios.index') }}" class="error-page__button error-page__button--secondary">Explorar estúdios</a>
		@auth
			<a href="{{ route('dashboard') }}" class="error-page__button error-page__button--ghost">Abrir dashboard</a>
		@endauth
	</div>

	<div class="error-page__card">
		<h2>O que podes fazer agora</h2>

		<ul>
			<li>Confirmar se o endereço está correto.</li>
			<li>Voltar ao início e navegar a partir do menu.</li>
			<li>Se o problema persistir, tenta outra secção do site.</li>
		</ul>
	</div>
</section>


@endsection
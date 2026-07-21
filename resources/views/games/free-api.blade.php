@extends('layouts.app')

@section('title', 'Consulta de Jogos')

@section('content')
    <section class="game-api" data-game-api>
        <div>
            <p class="game-api__eyebrow">Consulta externa</p>
            <h1>Jogos gratuitos para consulta</h1>
            <p class="game-api__lead">
                Lista simples de jogos vindos de uma API pública gratuita.
            </p>
        </div>

        <div class="game-api__controls">
            <button type="button" class="game-api__refresh" data-refresh-button>Atualizar lista</button>
        </div>

        <div class="game-api__status" data-status-box>
            A carregar jogos...
        </div>

        <div class="game-api__grid" data-results-grid></div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const root = document.querySelector('[data-game-api]');

            if (!root) {
                return;
            }

            const refreshButton = root.querySelector('[data-refresh-button]');
            const statusBox = root.querySelector('[data-status-box]');
            const resultsGrid = root.querySelector('[data-results-grid]');

            const setStatus = (message, isError = false) => {
                statusBox.textContent = message;
                statusBox.classList.toggle('is-error', isError);
            };

            const formatDate = (value) => {
                if (!value) {
                    return 'Sem data';
                }

                const date = new Date(value);

                if (Number.isNaN(date.getTime())) {
                    return value;
                }

                return new Intl.DateTimeFormat('pt-PT', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric',
                }).format(date);
            };

            const renderGames = (games) => {
                if (!games.length) {
                    resultsGrid.innerHTML = '';
                    setStatus('Sem resultados.');
                    return;
                }

                setStatus('Resultados carregados.');

                resultsGrid.innerHTML = games.map((game) => `
                    <article class="game-card">
                        <img src="${game.thumbnail}" alt="${game.title}" class="game-card__image" loading="lazy">
                        <div class="game-card__body">
                            <div class="game-card__topline">
                                <span>${game.genre ?? 'Sem género'}</span>
                                <span>${game.platform ?? 'Sem plataforma'}</span>
                            </div>
                            <h2>${game.title}</h2>
                            <p>${game.short_description ?? 'Descrição indisponível.'}</p>
                            <dl class="game-card__meta">
                                <div>
                                    <dt>Editor</dt>
                                    <dd>${game.publisher ?? 'N/A'}</dd>
                                </div>
                                <div>
                                    <dt>Lançamento</dt>
                                    <dd>${formatDate(game.release_date)}</dd>
                                </div>
                            </dl>
                            <a href="${game.game_url}" target="_blank" rel="noreferrer">Abrir jogo</a>
                        </div>
                    </article>
                `).join('');
            };

            const loadGames = async () => {
                setStatus('A carregar jogos...');
                resultsGrid.innerHTML = '';

                try {
                    const response = await fetch('https://www.freetogame.com/api/games');

                    if (!response.ok) {
                        throw new Error('A API respondeu com erro.');
                    }

                    const games = await response.json();
                    renderGames(games.slice(0, 12));
                } catch (error) {
                    console.error(error);
                    resultsGrid.innerHTML = '';
                    setStatus('Não foi possível consultar a API pública neste momento.', true);
                }
            };

            refreshButton.addEventListener('click', loadGames);

            loadGames();
        });
    </script>
@endsection
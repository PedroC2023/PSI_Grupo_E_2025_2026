<?php
// Website/frontend/views/site/index.php
?>
<style>
    .hero-about {
        position: relative;
        background-image: url('<?= Yii::getAlias('@web') ?>/images/logo.png');
        background-size: cover;
        background-position: center;
        padding: 60px 0;
        color: #fff;
        text-align: center;
    }

    .hero-about::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 0;
    }

    .about-container {
        position: relative;
        z-index: 1;
        max-width: 800px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.95);
        color: #222;
        padding: 40px 30px;
        border-radius: 16px;
        box-shadow: 0 12px 28px rgba(0,0,0,0.2);
    }

    .about-container h2 {
        margin-bottom: 20px;
        font-weight: 600;
    }

    .about-container p {
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .creator {
        margin-top: 40px;
        padding: 24px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.05);
    }

    .creator img {
        width: 96px;
        height: 96px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    @media (max-width: 767px) {
        .hero-about { padding: 40px 20px; }
        .creator { text-align: center; }
        .creator .creator-info { margin-top: 12px; }
    }
</style>

<div class="container py-4">
    <h1 class="text-center mb-3">Bem-vindo à Plataforma de Saúde</h1>
    <p class="text-center lead text-muted">Conectamos colaboradores e pacientes para uma gestão eficiente de eventos de saúde.</p>

    <section class="hero-about mt-4 rounded">
        <div class="container about-container">
            <h2>Sobre Nós</h2>
            <p>
                Somos uma plataforma de saúde dedicada a facilitar a interação entre colaboradores e pacientes.
                Os colaboradores podem criar e gerir eventos relacionados com saúde, enquanto os pacientes
                têm acesso a um calendário centralizado para visualizar e aderir aos eventos do seu interesse.
            </p>
            <p>
                O nosso objetivo é promover uma experiência simples e intuitiva, garantindo que todos possam participar
                de forma ativa em atividades de saúde, bem como acompanhar informações importantes de maneira eficiente.
            </p>
        </div>
    </section>

    <div class="container mt-5">
        <div class="creator d-flex align-items-center gap-3">
            <div class="creator-photo">
                <img src="https://avatars.githubusercontent.com/u/000?v=4" alt="Foto do criador">
            </div>
            <div class="creator-info">
                <h4 class="mb-1">Afonso Guedes</h4>
                <p class="mb-1 text-muted">Desenvolvedor Full‑stack — Design e implementação da plataforma</p>
                <p class="mb-0"><small class="text-muted">Email: <a href="mailto:2241604@ipleiria.pt">2241604@ipleiria.pt</a> · GitHub: <a href="https://github.com/Souber8" target="_blank" rel="noopener noreferrer">@Souber8</a></small></p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="creator d-flex align-items-center gap-3">
            <div class="creator-photo">
                <img src="https://avatars.githubusercontent.com/u/000?v=4" alt="Foto do criador">
            </div>
            <div class="creator-info">
                <h4 class="mb-1">Pedro Coelho</h4>
                <p class="mb-1 text-muted">Desenvolvedor Full‑stack — Design e implementação da plataforma</p>
                <p class="mb-0"><small class="text-muted">Email: <a href="mailto:2241614@ipleiria.pt">2241614@ipleiria.pt</a> · GitHub: <a href="https://github.com/PedroC2023" target="_blank" rel="noopener noreferrer">@PedroC2023</a></small></p>
            </div>
        </div>
    </div>
</div>

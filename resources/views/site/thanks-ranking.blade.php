@extends('site.template')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0 nopadding">
                <img src="{{ URL::to('/') }}/images/banner.png" width="100%" />
            </div>
        </div>    
        <div class="row">
            <div class="col-xs-12 col-xs-offset-0 col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                <img class="logo" src="{{ URL::to('/') }}/images/logo.png" />
                <h1 class="support">Empresas Mais Agradecidas</h1>
                <div>
                    <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1 ranking-box">
                        <h2 class="ranking-title">Agradecimentos por empresas</h2>
                	    @forelse($data['enterprisesRanking'] as $enterpriseRanking)
                            <img class="enterprise-logo" src="{{ URL::to('/') . $enterpriseRanking->logo }}" alt="Logo {{ $enterpriseRanking->enterprise }}" title="Logo {{ $enterpriseRanking->enterprise }}" /><p class="enterprise-name">{{ $enterpriseRanking->enterprise . " - " . $enterpriseRanking->thanks }}</p><img class="thanks-heart" src="{{ URL::to('/') }}/images/heart.png" alt="Coração" title="Coração" /><br>
                        @empty
                            <p class="enterprise-name">Ainda não existem agradecimentos cadastrados em nossa plataforma.</p>
                            <img class="heart" src="{{ URL::to('/') }}/images/heart.png" alt="Coração" title="Coração" />
                        @endforelse
                    </div>
                </div>
                <div>
                    <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1 ranking-box">
                        <h2 class="ranking-title">Agradecimentos por categorias</h2>
                        @forelse($data['categoriesRanking'] as $categoryRanking)
                            <p class="category-name">{{ $categoryRanking->category . " - " . $categoryRanking->thanks }}</p><img class="thanks-heart" src="{{ URL::to('/') }}/images/heart.png" alt="Coração" title="Coração" /><br>
                        @empty
                            <p class="category-name">Ainda não existem agradecimentos cadastrados em nossa plataforma.</p>
                            <img class="heart" src="{{ URL::to('/') }}/images/heart.png" alt="Coração" title="Coração" />
                        @endforelse
                    </div>
                </div>
                @forelse($data['enterprisesRankingByCategories'] as $enterprisesRankingByCategory)
                    <div>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1 ranking-box">
                            <?php $first = true; ?>
                            @foreach($enterprisesRankingByCategory as $enterpriseRankingByCategory)
                                @if($first)
                                    <h2 class="ranking-title">Agradecimentos por categoria - {{ $enterpriseRankingByCategory->name }}</h2>
                                    <img class="enterprise-logo" src="{{ URL::to('/') . $enterpriseRankingByCategory->logo }}" alt="Logo {{ $enterpriseRankingByCategory->enterprise }}" title="Logo {{ $enterpriseRankingByCategory->enterprise }}" /><p class="enterprise-name">{{ $enterpriseRankingByCategory->enterprise . " - " . $enterpriseRankingByCategory->thanks }}</p><img class="thanks-heart" src="{{ URL::to('/') }}/images/heart.png" alt="Coração" title="Coração" /><br>
                                    <?php $first = false; ?>
                                @else
                                    <img class="enterprise-logo" src="{{ URL::to('/') . $enterpriseRankingByCategory->logo }}" alt="Logo {{ $enterpriseRankingByCategory->enterprise }}" title="Logo {{ $enterpriseRankingByCategory->enterprise }}" /><p class="enterprise-name">{{ $enterpriseRankingByCategory->enterprise . " - " . $enterpriseRankingByCategory->thanks }}</p><img class="thanks-heart" src="{{ URL::to('/') }}/images/heart.png" alt="Coração" title="Coração" /><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div>
                        <div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1 ranking-box">
                            <p class="enterprise-name">Ainda não existem agradecimentos cadastrados em nossa plataforma.</p>
                            <img class="heart" src="{{ URL::to('/') }}/images/heart.png" alt="Coração" title="Coração" />
                        </div>
                    </div>
                @endforelse
			</div>
		</div>		        
    </div>

@endsection
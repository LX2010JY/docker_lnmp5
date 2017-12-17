<link type="text/css" rel="stylesheet" href="public/css/index/search.css" />
<div class="container-fluid">
    <div class="top-bar rows clearfix">
        <div class="col-md-6">
            <ul class="most-catgory">
                <li class="citem">11</li>
                <li class="citem">22</li>
                <li class="citem">33</li>
                <li class="citem">44</li>
                <li class="citem">55</li>
            </ul>
        </div>
        <div class="col-md-6">
            <div class="search">
                <div class="input-group">
                    <?php if ($q):?>
                    <input id="q" type="text" class="form-control" placeholder="Search for..." value="<?=$q;?>">
                    <?php else:?>
                    <input id="q" type="text" class="form-control" placeholder="Search for..." value="">
                    <?php endif?>
                    <span class="input-group-btn">
                            <button id="search-novel" class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search" style="line-height: 20px;" aria-hidden="true"></span>
                            </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <!--搜索结果展示部分-->
        <div class="col-md-8">
            <?php if ($list):?>
                <?php foreach ($list as $k => $v): ?>
                    <div class="novel-item rows clearfix">
                        <div class="col-md-3">
                            <img class="cover" src="<?=$v['cover']?>">
                        </div>
                        <div class="col-md-9">
                            <h1 class="title"><?=$v['title']?></h1>
                            <p class="author">作者：<?=$v['author']?>&nbsp;&nbsp;类型：<?=$v['category']?></p>
                            <div class="desc">
                                <?=$v['intro']?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php else:?>
                <div class="novel-item">
                    <div class="no_res">
                        没有搜索结果，<a href="">去其他网站查查吧！</a>
                    </div>
                </div>
            <?php endif;?>
        </div>
        <!--推荐部分-->
        <div class="col-md-4">
            推荐部分
        </div>
    </div>
</div>
<script type="text/javascript" src="public/js/index/index.js"></script>

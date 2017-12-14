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

    </div>
</div>
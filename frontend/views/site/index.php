<?php
/**
 * @var $products
 */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="row index-nav">
    <div class="col-md-6 col-sm-6 col-xs-6">
        <p class="text-left index-search-str">880 Ergebnisse fur <span>"best tech"</span>:</p>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <p class="text-right index-view-mode">
            <span class="glyphicon glyphicon-th-list"></span>
            <span class="glyphicon glyphicon-th"></span>
            Vergleichen
        </p>
    </div>
</div>

<div class="row index-nav index-filters">
    <div class="col-md-6 col-sm-6 col-xs-6">
        Filtern nach:
        <button class="btn btn-default btn-sm">GALAXY <span aria-hidden="true">&times;</span></button>
        <button class="btn btn-default btn-sm">S7 <span aria-hidden="true">&times;</span></button>
        <button class="btn btn-default btn-sm">Alles entfernen <span aria-hidden="true">&times;</span></button>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6">
        <div class="row clearfix">
            <div class="col-sm-4 col-xs-6 pull-right filter-list">
                <button class="btn btn-default btn-sm btn-block btn-text-left">Relevanz <span class="glyphicon glyphicon-chevron-down"></span></button>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($products)): ?>
<div class="products-list-wrap">
    <?php foreach($products as $product): ?>
    <div class="row index-nav">
        <div class="col-md-3 col-sm-3 col-xs-12 product-list-img">
            <?= (!empty($product['picture'])) ? Html::img($product['picture'], ['alt' => $product['title']]) : ''; ?>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12 product-list-title">
            <p>
                <?= Html::a($product['title'], $product['url']); ?>
            </p>
            <p>von <?= $product['brand']; ?></p>
            <p>
                <?= Html::img('@web/images/stars.png'); ?>
            </p>
            <p><a href="#">796 Bewertungsanalysen</a></p>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12 product-list-price">
            <div class="price-box">
                <div class="price-box-header">SEHR GUT</div>
                <div class="price-box-content"><?= $product['formatted_price']; ?></div>
                <div class="price-box-footer">ReviewScore</div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12 product-list-info">
            <?php
            $comments = [
                ['qty' => 219, 'title' => 'Akku'],
                ['qty' => 29, 'title' => 'Fingerprint'],
                ['qty' => 7, 'title' => 'Gear Vr'],
            ];
            foreach ($comments as $comment):
            ?>
            <div class="pli clearfix">
                <div class="pli-qty pull-left">
                    <span class="pli-qty-text">
                        <?= $comment['qty']; ?> <span class="glyphicon glyphicon-comment"></span>
                    </span>
                </div>
                <div class="pli-title pull-right">
                    <span><?= $comment['title']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="pli-link">
                <a href="#"><?= rand(10, 99); ?> weitere Schlusselthemen</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="row pagination-wrap">
    <div class="col-md-12">
        <ul class="pagination-list">
            <li class="pl-active">1</li>
            <li>2</li>
            <li>3</li>
            <li>4</li>
            <li class="html-spec">&rsaquo;</li>
            <li class="html-spec">&raquo;</li>
        </ul>
    </div>
</div>

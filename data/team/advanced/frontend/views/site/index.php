<?php
/**
* Team：数据四骑士,NKU
* Coding by 杜泽琦 2313508
* this is site index
*/

use yii\helpers\Url;

// 如果未传递 heroes 变量，则初始化为空数组
if (!isset($heroes)) {
    $heroes = [];
}


// [新增] 自动收集背景轮播图片（assets/images/backgrounds/ 下的 jpg/jpeg/png/webp）
$imagesDir = \Yii::getAlias('@webroot/assets/images/backgrounds/');
$bgImages = [];
if (is_dir($imagesDir)) {
  foreach (glob($imagesDir . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE) as $filePath) {
    $relative = str_replace(\Yii::getAlias('@webroot'), '', $filePath);
    $relative = str_replace('\\', '/', $relative); // Windows 路径转为 URL
    $bgImages[] = Url::to('@web' . $relative);
  }
}
// 兜底：至少有一张
if (empty($bgImages)) {
  $bgImages[] = Url::to('@web/assets/images/backgrounds/00quanjingtu.jpg');
}

$css = <<<CSS
/*全局：标题/副标题（你说的黑色细体字）美化*/
.section-title-red{
  font-size: 44px;
  letter-spacing: 2px;
  color: #7a1d1d;
  font-weight: 800;
  margin-bottom: 12px;
}
.section-subtitle{
  font-size: 18px;
  color: rgba(0,0,0,.55);
  letter-spacing: 1px;
  margin: 0;
}

/* 顶部那条“1945 2025 ...”如果是 hero-subtitle，可直接增强 */
.hero-subtitle{
  font-size: 18px;
  letter-spacing: 3px;
  color: rgba(0,0,0,.60);
  font-weight: 500;
}

/* 背景轮播（平移过渡） */
.hero-background{
  position:absolute;
  inset:0;
  z-index:0;
  overflow:hidden;
}
.hero-background .bg-slide{
  position:absolute;
  top:0; left:0;
  width:100%; height:100%;
  object-fit: cover;
  transform: translateX(100%); /* 初始在右侧待入场 */
  opacity: 0;
  transition: transform 900ms ease-in-out, opacity 900ms ease-in-out;
  will-change: transform, opacity;
}
.hero-background .bg-slide.is-active{
  transform: translateX(0);    /* 入场到中间 */
  opacity: 1;
}
.hero-background .bg-slide.is-exit{
  transform: translateX(-100%);/* 出场到左侧 */
  opacity: 0;
}

/* 时间轴*/
.home-war-timeline{
  background: #f1ece2ff;
}

.home-war-timeline .timeline-stage{
  background: rgba(0,0,0,.03);
  border-radius: 14px;
  padding: 26px 26px 10px 26px;
}

.home-war-timeline .timeline-container{
  position: relative;
  padding: 10px 0;
}

/* 中间竖线 */
.home-war-timeline .timeline-container:before{
  content:"";
  position:absolute;
  left:50%;
  top:18px;
  bottom:18px;
  width:3px;
  transform: translateX(-50%);
  background: linear-gradient(to bottom, rgba(180,120,30,0), rgba(180,120,30,.85), rgba(180,120,30,0));
  z-index: 1; 
}

/* 去掉时间轴中间竖线 */
.home-war-timeline .timeline-container::before{
    display: none;
}

/* 默认就可见 */
.home-war-timeline .hero-timeline__item{
  position: relative;
  z-index: 2;           /* 内容在竖线上方，避免被遮盖 */
  display:flex !important;
  align-items:flex-start !important;
  gap: 24px !important;
  margin: 0 0 26px 0 !important;
  opacity: 1;
  transform: none;
}

.home-war-timeline .timeline-date{
  min-width: 140px;
  font-size: 48px;
  font-weight: 900;
  color: #b8882a;
  line-height: 1;
}

.home-war-timeline .timeline-content{
  flex: 1 1 auto;
  margin-left: auto;
  text-align: right;
  padding-right: 8px;
  opacity: 1 !important;
}

.home-war-timeline .event-title{
  font-size: 26px;
  font-weight: 900;
  color:#7a1d1d;
  margin: 0 0 10px 0;
}
.home-war-timeline .event-desc{
  margin: 0;
  color: rgba(0,0,0,.62);
  line-height: 1.8;
  font-size: 16px;
}

/* 进入视口动画：由 JS 给 stage 加 is-animating，再给 item 加 is-visible */
.home-war-timeline .timeline-stage.is-animating .hero-timeline__item{
  opacity: 0;
  transform: translateY(40px);
}
.home-war-timeline .timeline-stage.is-animating .hero-timeline__item.is-visible{
  opacity: 1;
  transform: translateY(0);
  transition: opacity .6s ease, transform .6s ease;
}


/* 时间轴事件之间的横向分隔线 */
.home-war-timeline .hero-timeline__item{
    position: relative;
    padding-bottom: 26px;
    margin-bottom: 26px;
}

/* 分隔线本身 */
.home-war-timeline .hero-timeline__item::after{
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;

    height: 1px;
    background: linear-gradient(
        to right,
        rgba(0,0,0,0),
        rgba(180,120,30,.45),
        rgba(0,0,0,0)
    );
}

/* 统计区：更正式的字体 + 放大 */
#stats-section{
  font-family: "Songti SC","STSong","Noto Serif SC","Source Han Serif SC",
               "SimSun","Microsoft YaHei","PingFang SC",serif;
}

#stats-section .stat-card{
  padding: 22px 14px;         /* 让内容更“端正” */
}

#stats-section .stat-number{
  font-size: 46px;            /* 数字更大 */
  font-weight: 900;
  letter-spacing: 1px;
  line-height: 1.1;
  color: rgba(0,0,0,.85);
}

#stats-section .stat-number .small{
  font-size: 18px;            /* 单位（年/万+/场/+） */
  font-weight: 700;
  margin-left: 6px;
  color: rgba(0,0,0,.75);
}

#stats-section .stat-label{
  margin-top: 10px;
  font-size: 18px;            /* 文案更大 */
  font-weight: 700;
  letter-spacing: 2px;        /* 更“正式” */
  color: rgba(0,0,0,.70);
}
#stats-section .stat-number{
  color: #8b5e12; /* 金棕 */
}

/* ============ 按钮美化 ============ */
/* 首页「瞻仰更多英雄」按钮 - 改为纪念金棕色 */
.btn-hero-primary{
    background: linear-gradient(
        135deg,
        #c9a14a 0%,
        #a67c1b 100%
    );
    color: #3b2a00;

    box-shadow:
        0 10px 22px rgba(0,0,0,.25),
        inset 0 1px 1px rgba(255,255,255,.35);
}

.btn-hero-primary:hover{
    filter: brightness(1.05);
    box-shadow:
        0 14px 30px rgba(0,0,0,.30),
        inset 0 1px 1px rgba(255,255,255,.45);
}

.btn-gold-outline{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  padding: 10px 24px;
  border-radius: 10px;
  text-decoration:none;
  font-weight: 700;
  letter-spacing: 1px;
  color: #8b5e12;
  border: 1px solid rgba(245, 195, 12, 0.93);
  background: rgba(245, 195, 12, 0.93);
  transition: transform .15s ease, background .15s ease;
}
.btn-gold-outline:hover{
  transform: translateY(-2px);
  background: rgba(255,255,255,.55);
}

/* ============ 英雄卡片（首页 4 张） ============ */
.hero-card-skeleton{
  height: 260px;
  border-radius: 14px;
  background: linear-gradient(90deg, rgba(0,0,0,.06), rgba(0,0,0,.12), rgba(0,0,0,.06));
  background-size: 200% 100%;
  animation: skeleton 1.1s infinite;
}
@keyframes skeleton{
  0%{ background-position: 200% 0; }
  100%{ background-position: -200% 0; }
}

.home-hero-card{
  border-radius: 14px;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 8px 24px rgba(0,0,0,.07);
  height: 100%;
  display: flex;
  flex-direction: column;
  text-decoration: none;
  color: inherit;
  transition: transform .15s ease, box-shadow .15s ease;
}
.home-hero-card:hover{
  transform: translateY(-3px);
  box-shadow: 0 12px 30px rgba(0,0,0,.10);
}
.home-hero-card .cover{
  height: 168px;
  background: #f2f2f2 center/cover no-repeat;
}
.home-hero-card .body{
  padding: 14px 14px 16px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.home-hero-card .name{
  font-weight: 900;
  font-size: 16px;
  margin: 0;
}
.home-hero-card .brief{
  margin: 0;
  color: rgba(0,0,0,.65);
  font-size: 13px;
  line-height: 1.55;
}
.home-hero-card .meta{
  margin-top: auto;
  display:flex;
  justify-content: space-between;
  align-items:center;
  gap: 10px;
}
.home-hero-card .tag{
  font-size: 12px;
  padding: 4px 10px;
  border-radius: 999px;
  background: rgba(176, 132, 60, .12);
  color: #8b5e12;
  white-space: nowrap;
}

/* 首屏倒计时：使用与历史数据一致的“正式字体” */
.hero-countdown{
  font-family: "Songti SC","STSong","Noto Serif SC","Source Han Serif SC",
               "SimSun","Microsoft YaHei","PingFang SC",serif;
}

/* 数字更庄重 */
.hero-countdown .number{
  font-size: 44px;          /* 你可按需要调大/调小 */
  font-weight: 900;
  letter-spacing: 1px;
  line-height: 1.1;
  color: rgba(0,0,0,.85);
}

/* 单位（周年/天） */
.hero-countdown .label{
  font-size: 18px;
  font-weight: 700;
  letter-spacing: 2px;
  color: rgba(0,0,0,.70);
  margin-left: 6px;
}

/* 每个倒计时块整体更端正一些 */
.hero-countdown .countdown-item{
  padding: 6px 10px;
}
.hero-countdown .number{ color:#8b5e12; }


/*改！！！！！！！！！！！！！！！！！！！！！！！！！*/
.hero-background .overlay{
    position:absolute;
    inset:0;
    background: linear-gradient(
        to bottom,
        rgba(0,0,0,0.05) 0%,
        rgba(0,0,0,0.15) 35%,
        rgba(0,0,0,0.45) 65%,
        rgba(0,0,0,0.70) 100%
    );
    z-index:1;
}
.hero-section{
    position: relative;
    height: 100vh;
    overflow: hidden;
}

.hero-content{
    position: absolute;
    left: 50%;
    bottom: 18%;              /* 👈 控制整体高度，推荐 15%~22% */
    transform: translateX(-50%);
    z-index: 3;
    text-align: center;
    color: #fff;
}

.hero-countdown{
    display: inline-flex;
    gap: 28px;
    margin-top: 26px;
    padding: 12px 28px;
    border-radius: 14px;
    background: rgba(0,0,0,.25);
    backdrop-filter: blur(2px);
}

.hero-countdown .number{
    color: #f5d48a;   /* 金色，和你整体风格一致 */
}

.hero-countdown .label{
    color: rgba(255,255,255,.85);
}

.hero-title{
    font-size: 56px;
    font-weight: 900;
    line-height: 1.25;
    letter-spacing: 2.5px;
    color: #ffffff;

    text-shadow:
        0 4px 14px rgba(0,0,0,.45);

    margin: 0;
}
.hero-title-wrapper{
    display: inline-block;
    padding: 22px 36px 24px;
    background: rgba(130, 0, 0, 0.55);
    border-radius: 6px;
}

.hero-subtitle{
    margin-top: 18px;
    padding: 12px 30px;

    font-size: 22px;
    font-weight: 700;
    letter-spacing: 3px;

    color: #ffffff;
    background: rgba(90, 0, 0, 0.65);
    border-radius: 4px;

    text-shadow: 0 2px 8px rgba(0,0,0,.35);
}

CSS;

$this->registerCss($css);

// [新增] 轮播控制 JS（每 4s 切换一次）
$this->registerJs(<<<JS
(function(){
  const slides = document.querySelectorAll('.hero-background .bg-slide');
  if (!slides.length) return;

  let idx = 0;
  const intervalMs = 4000; // 切换间隔

  // 初始状态
  slides.forEach((s, i) => {
    s.classList.remove('is-active','is-exit');
    if (i === 0) s.classList.add('is-active');
  });

  setInterval(() => {
    const current = slides[idx];
    const nextIdx = (idx + 1) % slides.length;
    const next = slides[nextIdx];

    // 当前图片左侧滑出
    current.classList.remove('is-active');
    current.classList.add('is-exit');

    // 下一张右侧滑入
    next.classList.remove('is-exit');
    next.classList.add('is-active');

    // 过渡结束后清理出场标记
    setTimeout(() => current.classList.remove('is-exit'), 950);

    idx = nextIdx;
  }, intervalMs);
})();
JS);

?>

<!-- [1] HERO SECTION - 首屏震撼区 -->
<section class="hero-section">
    <div class="hero-background">
        <!-- 修改：用循环输出多张背景 -->
        <?php foreach ($bgImages as $i => $imgUrl): ?>
          <img class="bg-slide <?= $i === 0 ? 'is-active' : '' ?>" src="<?= $imgUrl ?>" alt="背景<?= $i + 1 ?>">
        <?php endforeach; ?>
        
        <div class="overlay"></div>
    </div>

    <div id="particles-js" style="position:absolute;top:0;left:0;width:100%;height:100%;"></div>

    <div class="hero-content container">
        <h1 class="hero-title" data-animate>
            纪念中国人民抗日战争<br>暨世界反法西斯战争胜利80周年
        </h1>

        <p class="hero-subtitle" data-animate>
            1945—2025：铭记历史 缅怀先烈 珍爱和平 开创未来
        </p>

        <div class="hero-countdown" data-animate>
            <div class="countdown-item">
                <span class="number">80</span>
                <span class="label">周年</span>
            </div>
            <!-- <div class="countdown-item">
                <span class="number">270</span>
                <span class="label">天</span>
            </div> -->
        </div>

        <a href="#stats-section" class="scroll-indicator">
            <i class="icon-arrow-down"></i>
        </a>
    </div>
</section>

<!-- [2] 历史数据统计区 -->
<section id="stats-section" class="stats-section section-padding">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4" data-animate>
                <div class="stat-card">
                    <div class="stat-number">14<span class="small">年</span></div>
                    <div class="stat-label">抗战岁月</div>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-animate>
                <div class="stat-card">
                    <div class="stat-number">3500<span class="small">万+</span></div>
                    <div class="stat-label">伤亡同胞</div>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-animate>
                <div class="stat-card">
                    <div class="stat-number">22<span class="small">场</span></div>
                    <div class="stat-label">重大战役</div>
                </div>
            </div>
            <div class="col-md-3 mb-4" data-animate>
                <div class="stat-card">
                    <div class="stat-number">200<span class="small">+</span></div>
                    <div class="stat-label">抗战英雄</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- [3] 抗战时间轴预览-->
<section class="home-war-timeline section-padding" id="home-war-timeline">
  <div class="container">
    <div class="section-header text-center mb-5">
      <h2 class="section-title-red">抗战历史长卷</h2>
      <p class="section-subtitle">十四年浴血抗战 民族走向伟大复兴</p>
    </div>

    <div class="timeline-stage" id="home-timeline-stage">
      <div class="timeline-container" id="home-timeline-container">
        <!-- 1931年：九一八事变 -->
        <div class="hero-timeline__item">
          <div class="timeline-date">1931</div>
          <div class="timeline-content">
            <h3 class="event-title">九一八事变</h3>
            <p class="event-desc">东北沦陷，民族危机全面加深。</p>
          </div>
        </div>

        <!-- 1935年：一二·九运动 -->
        <div class="hero-timeline__item">
          <div class="timeline-date">1935</div>
          <div class="timeline-content">
            <h3 class="event-title">一二·九运动</h3>
            <p class="event-desc">北平学生掀起抗日救亡爱国运动，推动全民抗战浪潮。</p>
          </div>
        </div>

        <!-- 1936年：西安事变 -->
        <div class="hero-timeline__item">
          <div class="timeline-date">1936</div>
          <div class="timeline-content">
            <h3 class="event-title">西安事变</h3>
            <p class="event-desc">事变和平解决，标志着国共两党十年内战基本结束，抗日民族统一战线初步形成。</p>
          </div>
        </div>

        <!-- 1937年：七七事变 -->
        <div class="hero-timeline__item">
          <div class="timeline-date">1937</div>
          <div class="timeline-content">
            <h3 class="event-title">七七事变</h3>
            <p class="event-desc">全民族抗战爆发，进入全面抗战阶段。</p>
          </div>
        </div>

        <!-- 1937年：淞沪会战 -->
        <div class="hero-timeline__item">
          <div class="timeline-date">1937</div>
          <div class="timeline-content">
            <h3 class="event-title">淞沪会战</h3>
            <p class="event-desc">中国军队奋起抵抗，打破日本三个月灭亡中国的妄想。</p>
          </div>
        </div>

        <!-- 1937年：南京大屠杀 -->
        <div class="hero-timeline__item">
          <div class="timeline-date">1937</div>
          <div class="timeline-content">
            <h3 class="event-title">南京大屠杀</h3>
            <p class="event-desc">日军攻占南京，进行长达六周的血腥屠杀，三十万同胞遇难。</p>
          </div>
        </div>

        <!-- 1938年：台儿庄战役 -->
        <div class="hero-timeline__item">
          <div class="timeline-date">1938</div>
          <div class="timeline-content">
            <h3 class="event-title">台儿庄战役</h3>
            <p class="event-desc">中国军队取得正面战场首次重大胜利，振奋全国抗战士气。</p>
          </div>
        </div>

        <!-- 1940年：百团大战 -->
        <div class="hero-timeline__item">
          <div class="timeline-date">1940</div>
          <div class="timeline-content">
            <h3 class="event-title">百团大战</h3>
            <p class="event-desc">八路军发动大规模破袭战，沉重打击日军气焰，增强抗战信心。</p>
          </div>
        </div>

        <!-- 1945年：日本投降 -->
        <div class="hero-timeline__item">
          <div class="timeline-date">1945</div>
          <div class="timeline-content">
            <h3 class="event-title">日本投降</h3>
            <p class="event-desc">世界反法西斯战争胜利，中华民族迎来抗日战争的最终胜利。</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="heroes-section section-padding" id="home-heroes">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title-red">抗战英雄谱</h2>
            <p class="section-subtitle">天地英雄气 千秋尚凛然</p>
        </div>

        <div class="row" id="home-heroes-list">
            <?php foreach ($heroes as $hero): ?>
                <?php 
                    $tag = ($hero->rank === 'general') ? '抗战将领' : '抗战英雄';
                    $imgUrl = Url::to('@web/assets/images/heroes/' . $hero->photo);
                ?>
                <div class="col-md-3 mb-4">
                    <a class="home-hero-card"
                       href="<?= Url::to(['/heroes/view', 'id' => $hero->id]) ?>">
                        <div class="cover"
                             style="background-image:url('<?= $imgUrl ?>')"></div>
                        <div class="body">
                            <p class="name"><?= htmlspecialchars($hero->name, ENT_QUOTES) ?></p>
                            <p class="brief"><?= htmlspecialchars($hero->introduction, ENT_QUOTES) ?></p>
                            <div class="meta">
                                <span class="tag"><?= $tag ?></span>
                                <span class="text-muted" style="font-size:12px;">查看</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?= \yii\helpers\Url::to('@web/heroes') ?>"
                class="btn btn-hero-primary"
                style="position:relative; z-index:5; pointer-events:auto;">
                瞻仰更多英雄
            </a>
        </div>
    </div>
</section>


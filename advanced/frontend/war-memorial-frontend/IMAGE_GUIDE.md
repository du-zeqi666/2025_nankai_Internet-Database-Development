# 网站图片资源配置指南

为了使网站显示美观，请将相应的图片文件放置在 `public/assets/images` 目录下的相应子目录中。

## 目录结构说明

请确保以下目录结构存在于 `public/assets/images/`：

```
public/assets/images/
├── heroes/          (抗战英烈)
├── battles/         (重大战役)
├── timeline/        (历史时间轴)
├── relics/          (文物史料)
├── sites/           (纪念场馆)
├── backgrounds/     (背景图片)
└── icons/           (图标)
```

## 需要的图片清单

### 1. 首页 (Home)
- `backgrounds/hero-bg.jpg` - 首页顶部大图背景 (建议尺寸: 1920x1080)
- `heroes/yangjingyu.jpg` - 杨靖宇肖像 (建议尺寸: 400x300)
- `heroes/zuoquan.jpg` - 左权肖像 (建议尺寸: 400x300)
- `heroes/zhangzizhong.jpg` - 张自忠肖像 (建议尺寸: 400x300)

### 2. 抗战英烈 (Heroes)
- `heroes/placeholder.jpg` - 默认英雄头像 (当没有特定照片时显示)

### 3. 重大战役 (Battles)
- `battles/pingxingguan.jpg` - 平型关大捷 (建议尺寸: 800x450)
- `battles/taierzhuang.jpg` - 台儿庄大捷 (建议尺寸: 800x450)
- `battles/baituan.jpg` - 百团大战 (建议尺寸: 800x450)

### 4. 历史时间轴 (Timeline)
- `timeline/1931.jpg` 至 `timeline/1945.jpg` - 对应年份的历史照片 (建议尺寸: 600x400)

### 5. 文物史料 (Relics)
- `relics/gun.jpg` - 三八式步枪
- `relics/diary.jpg` - 战地日记
- `relics/uniform.jpg` - 八路军军服

### 6. 纪念场馆 (Sites)
- `sites/nanjing.jpg` - 南京大屠杀遇难同胞纪念馆
- `sites/shenyang.jpg` - “九·一八”历史博物馆
- `sites/lugouqiao.jpg` - 中国人民抗日战争纪念馆

## 美化建议

1. **图片质量**：请使用清晰度高的历史照片，但注意压缩文件大小以保证加载速度（建议单张不超过 500KB）。
2. **风格统一**：尽量选择黑白或怀旧色调的照片，以符合历史纪念网站的庄重氛围。
3. **比例一致**：同一栏目下的图片尽量保持相同的长宽比，避免页面排版错乱。

## 字体配置
如果页面字体显示异常，请确保 `public/assets/fonts/` 目录下包含以下字体文件：
- `SourceHanSerifCN/SourceHanSerifCN-Bold.otf`
- `SourceHanSansCN/SourceHanSansCN-Regular.otf`

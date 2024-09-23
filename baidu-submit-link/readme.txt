=== 多合一搜索自动推送管理插件-支持Baidu/Google/Bing/IndexNow/Yandex/头条 ===
Contributors: wbolt,mrkwong
Donate link: https://www.wbolt.com/
Tags: Baidu, SEO, Bing, toutiao, Google, IndexNow, Yandex, 360
Requires at least: 6.0
Tested up to: 6.5
Stable tag: 4.2.11
License: GNU General Public License v3.0 or later
Requires PHP: 7.0

多合一搜索自动推送管理插件（原百度搜索推送管理插件）是一款针对WP开发的功能非常强大的百度、Google、Bing、IndexNow、Yandex和头条搜索引擎链接推送插件。协助站长将网站资源快速推送至各大搜索引擎，有利于提升网站的搜索引擎收录效率；该插件还提供文章百度收录查询功能。

== Description ==

多合一搜索自动推送管理插件（原百度搜索推送管理插件）是一款针对WP开发的功能非常强大的百度、Google、Bing、IndexNow、Yandex和头条搜索引擎链接推送插件。协助站长将网站资源快速推送至各大搜索引擎，有利于提升网站的搜索引擎收录效率；该插件还提供文章百度收录查询功能。

多合一搜索自动推送管理插件包括三大功能模块：

### 1. 数据统计模块

1.1 **整站收录统计**-支持快速查看网站的百度和bing的收录数&收录趋势折线图。

* **新增收录对比表**-支持按月新增、季新增和年新增收录查看当前时间及上一周期的收录总数，及新增收录数。
* **收录趋势图**-支持按近7天和30天查看百度和bing的收录走势图。

1.2 **搜索推送统计**-支持按最近7天&30天快速查看百度搜索、谷歌推送、Bing推送及头条/IndexNow/Yandex等搜索引擎站长平台推送数据统计。

1.3 **百度收录统计**-包括收录概况、文章收录分布及文章收录列表三部分。

* **收录概况**-可查看全站收录、已收录文章、未收录文章及文章收录占比四个数据指标。
* **收录分布**-可查看不同分类的文章收录数据，以便于站长了解网站不同文章分类的收录情况，进一步优化网站内容结构。
* **文章收录列表**-支持按未收录或者已收录状态筛选查看网站文章列表，以便于站长快速了解网站的文章收录情况。收录文章清单采用了闪电博团队自主研发的百度收录状态查询API接口，能够高效率地处理整站文章的收录状态查询工作，并且准确率更高。站长还可以即时查询文章百度收录状况及搜索引擎蜘蛛爬取该文章的历史记录，以便于对搜索引擎收录做进一步的分析。
* **收录列表操作项**-支持对百度收录统计文章执行检测收录、标记收录、蜘蛛爬取日志查看及强推未收录文章至百度等操作。

1.4 **死链提交清单**-支持读取<a href="https://www.wbolt.com/plugins/spider-analyser?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="蜘蛛插件">Spider Analyser</a>-蜘蛛分析插件的404状态网站死链数据，并以列表的形式展示URL地址、响应码状态、检测时间及操作项等，并支持站长下载死链链接列表提交至百度搜索资源平台执行删除，以免影响网站的站点评级。同时，还可以对死链执行刷新状态和忽略等操作。

> ℹ️ <strong>Tips</strong> 
> 
> 1.强推百度，建议对文章进行标题、摘要及内容调整后，再操作。参考阅读<a href="https://www.wbolt.com/republishing-content.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="文章重建">炒冷饭也是做好SEO的一种手段</a>。
> 2.不建议使用过长的URL链接，不利于SEO优化，查看<a href="https://www.wbolt.com/republishing-content.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="固定链接设置教程">WP固定链接设置教程</a>。
> 3.要提升搜索引擎收录效率，务必实施的<a href="https://www.wbolt.com/wordpress-seo-tips.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="WordPress SEO技巧">60+ WordPress SEO技巧</a>。
> 4.关于死链的处理，建议参考<a href="https://www.wbolt.com/how-to-fix-404-error-in-wordpress.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="404链接处理">404链接处理教程</a>。
> 5.死链检测数据需通过安装<a href="https://www.wbolt.com/plugins/spider-analyser?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="Spider Analyser插件">Spider Analyser插件</a>获取。

### 2. 推送日志模块

推送日志模块包括百度推送推送、Bing推送及插件执行日志，站长可以通过该功能模块查看最近7天推送URL和推送状态，插件执行日志将会记录输出插件执行的相关任务记录，以方便开发者快速定位插件问题。

2.1 **百度推送日志**-支持查看百度普通收录推送及快速收录推送相关日志，日志列表包括推送日期、推送链接及推送状态，并支持一键清除日志。

2.2 **谷歌推送日志**-支持查看谷歌站长索引推送及链接删除推送相关日志，日志列表包括推送日期、推送链接及推送状态，并支持一键清除日志。

2.3 **Bing推送日志**-支持查看Bing手动推送及自动推送相关日志，日志列表包括推送日期、推送链接及推送状态，并支持一键清除日志。

2.4 **其他推送日志**-支持查看IndexNow、Yandex和头条搜索站长平台推送的所有链接日志，包括日期、链接及推送状态，并支持一键清除日志。

2.5 **插件执行日志**-该功能主要用于站长快速查看插件执行的收录推送、定时任务、收录查询、收录概况等插件相关执行日志记录，以便于快速定位排除插件问题。

> ℹ️ <strong>Tips</strong> 
> 
> 1.<a href="https://www.wbolt.com/google-indexing-api-setting.html#comment-errors?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="百度推送常见错误解决办法">百度推送常见错误解决办法</a>。
> 2.<a href="https://www.wbolt.com/google-indexing-api-setting.html#comment-errors?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="Google推送错误解决办法">常见Google推送错误解决办法</a>。
> 3.<a href="https://www.wbolt.com/fix-bing-url-submission-api-error.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="Bing推送常见错误及解决办法">Bing推送常见错误及解决办法</a>。
> 4.推送失败另一常见原因为“超时”，解决办法为执行网站测速，然后实施<a href="https://www.wbolt.com/speed-up-wordpress.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="提升网站加载速度">提升网站加载速度策略</a>。

### 3. 插件设置模块


3.1 **常规设置**

* **（1）推送文章类型**-支持站长自定义不同的文章类型，推送至百度搜索资源平台；
* **（2）日志保留时间**-支持按24小时、3天及7天保留推送日志等数据，默认设置项为7天。
* **（3）死链检测设置**-支持死链检测设置启用或关闭操作，及Spider Analyser插件安装启用检测。

3.2 **推送API设置**


* **（1）百度推送设置**-支持站长填入百度推送API接口调用地址，实现百度普通收录自动推送、主动推送、快速收录推送及Sitemap推送。

* **主动推送**-支持博主通过配置百度主动推送准入密钥，主动向Baidu提交网站新增、更新和删除内容URL。并且可查看最近三十天的推送数据及推送错误日志。
* **自动推送**-支持站长开启百度普通收录的自动推送功能，启用该功能后会网站页面添加百度搜索资源平台官方的自动推送js代码，同时启用插件的自动推送数据统计等功能。
* **快速收录推送**-即原有的天级收录推送功能，内容享受快速抓取校验、快速搜索展现。快速收录推送的效率远高出百度搜索资源平台的普通收录推送，只要你的文章内容原创度足够高，一般能够快速校验收录。目前仅优质内容网站，原来熊掌ID天级收录有配额或者提交小程序的网站具备快速收录配额。
* **Sitemap推送**-Sitemap推送功能也是百度站长URL提交功能之一，本插件只实现读取WordPress博客sitemap生成状态，方便博主快速复制Sitemap地址，到百度站长平台提交sitemap地址。最新版本的sitemap文件检测已兼容更多的Sitemap插件，包括All in One SEO Pack, SEOPress, Yoast SEO, Google XML Sitemaps等。

* **（2）谷歌推送设置**-支持配置Google index api以实现快速通知Google索引新发布内容及删除链接要求。

* **（3）Bing推送设置**-支持配置Bing推送API密钥及启用关闭Bing自动或手动推送功能。

* **（4）IndexNow推送设置**-支持配置IndexNow APIkey以实现IndexNow、Bing、Seznam和Yandex自动推送。

* **（5）Yandex推送设置**-支持配置Yandex应用ID和密码实现俄罗斯最大的搜索引擎搜索推送功能。

* **（6）头条推送推送设置**-支持贴入头条站长平台生成的快速收录推送JS代码，实现数据自动推送至头条搜索；并且支持批量推送链接。

> ℹ️ <strong>Tips</strong> 
> 
> 1.Sitemap生成建议安装<a href="https://www.wbolt.com/plugins/sst?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="Google推送错误解决办法">Smart SEO Tool</a>生成
> 2.获取百度普通收录或者快速收录API提交推送接口调用地址，<a href="https://www.wbolt.com/how-to-get-baidu-tokenid.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="获取百度API提交推送接口调用地址">查看教程</a>。
> 3.如何获取Indexing API密钥配置文件，<a href="https://www.wbolt.com/google-indexing-api-setting.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="获取Indexing API密钥">查看教程</a>。
> 4.访问Bing网站管理员工具生成API密钥，<a href="https://www.wbolt.com/generate-bing-api-key.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="获取Bing站长管理工具API密钥">查看教程</a>。

3.3 **插件助手**

站长可以安装我们自主开发的插件助手，绑定网站域名后，可在360、搜狗或者头条站长平台后台，快速获取最近7天链接，手动推送至对应的搜索引擎。

> **温馨提示**：上述部分功能，仅Pro版本提供，具体功能对比请访问插件设置界面的功能对比图。

多合一搜索自动推送管理插件是目前WordPress关于搜索引擎数据推送及收录查询方面功能最为强大的插件，实现了网站数据快速推送至百度、Bing和360等多个搜索引擎，获取文章百度收录状态及查看文章蜘蛛爬取记录等。


WordPress站长可以利用该插件，并结合<a href='https://www.wbolt.com/plugins/sst?utm_source=wp&utm_medium=link&utm_campaign=bsl' rel='friend' title='WordPress网站SEO优化插件'>WordPress网站SEO优化插件</a>、<a href='https://www.wbolt.com/plugins/spider-analyser?utm_source=wp&utm_medium=link&utm_campaign=bsl' rel='friend' title='蜘蛛统计分析插件'>蜘蛛统计分析插件</a>和<a href='https://www.wbolt.com/plugins/skt?utm_source=wp&utm_medium=link&utm_campaign=bsl' rel='friend' title='关键词推荐插件'>关键词推荐插件</a>，对WordPress网站内容的搜索引擎收录及排名优化可以做到事半功倍的效果！

== 其他WP插件 ==

多合一搜索自动推送管理插件是目前WordPress插件市场中功能最完善和最强大的<a href="https://www.wbolt.com/plugins/bsl?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="最好用的多合一搜索自动推送管理插件">百度、Bing和360多合一搜索自动推送管理插件</a>. 插件同时提供三种推送方式，且简单易用，超轻量代码设计，无论是老站还是新站，使用该插件都对百度、Bing和360搜索引擎优化有较大的作用。

闪电博（<a href='https://www.wbolt.com/?utm_source=wp&utm_medium=link&utm_campaign=bsl' rel='friend' title='闪电博官网'>wbolt.com</a>）专注于原创<a href='https://www.wbolt.com/themes' rel='friend' title='WordPress主题'>WordPress主题</a>和<a href='https://www.wbolt.com/plugins' rel='friend' title='WordPress插件'>WordPress插件</a>开发，为中文博客提供更多优质和符合国内需求的主题和插件。此外我们也会分享WordPress相关技巧和教程。

除了多合一搜索自动推送管理插件外，目前我们还开发了以下WordPress插件：

- [Spider Analyser–搜索引擎蜘蛛分析插件](https://wordpress.org/plugins/spider-analyser/)
- [热门关键词推荐插件-最佳关键词布局插件](https://wordpress.org/plugins/smart-keywords-tool/)
- [IMGspider-轻量外链图片采集插件](https://wordpress.org/plugins/imgspider/)
- [Smart SEO Tool-高效便捷的WP搜索引擎优化插件](https://wordpress.org/plugins/smart-seo-tool/)
- [MagicPost – WordPress文章管理功能增强插件](https://wordpress.org/plugins/magicpost/)
- [WPTurbo -WordPress性能优化插件](https://wordpress.org/plugins/wpturbo/)
- [WP VK-WordPress知识付费插件](https://wordpress.org/plugins/wp-vk/)
- [Online Contact Widget-多合一在线客服插件](https://wordpress.org/plugins/online-contact-widget/)

- 更多主题和插件，请访问<a href='https://www.wbolt.com/?utm_source=wp&utm_medium=link&utm_campaign=bsl' rel='friend' title='闪电博官网'>wbolt.com</a>!

如果你在WordPress主题和插件上有更多的需求，也希望您可以向我们提出意见建议，我们将会记录下来并根据实际情况，推出更多符合大家需求的主题和插件。

== WordPress资源 ==

由于我们是WordPress重度爱好者，在WordPress主题插件开发之余，我们还独立开发了一系列的在线工具及分享大量的WordPress教程，供国内的WordPress粉丝和站长使用和学习，其中包括：

**<a href="https://www.wbolt.com/learn?utm_source=wp&utm_medium=link&utm_campaign=bsl" target="_blank">1. Wordpress学院:</a>** 这里将整合全面的WordPress知识和教程，帮助您深入了解WordPress的方方面面，包括基础、开发、优化、电商及SEO等。WordPress大师之路，从这里开始。

**<a href="https://www.wbolt.com/tools/keyword-finder?utm_source=wp&utm_medium=link&utm_campaign=bsl" target="_blank">2. 关键词查找工具:</a>** 选择符合搜索用户需求的关键词进行内容编辑，更有机会获得更好的搜索引擎排名及自然流量。使用我们的关键词查找工具，以获取主流搜索引擎推荐关键词。

**<a href="https://www.wbolt.com/tools/wp-fixer?utm_source=wp&utm_medium=link&utm_campaign=bsl">3. WOrdPress错误查找:</a>** 我们搜集了大部分WordPress最为常见的错误及对应的解决方案。您只需要在下方输入所遭遇的错误关键词或错误码，即可找到对应的处理办法。

**<a href="https://www.wbolt.com/tools/seo-toolbox?utm_source=wp&utm_medium=link&utm_campaign=bsl">4. SEO工具箱:</a>** 收集整理国内外诸如链接建设、关键词研究、内容优化等不同类型的SEO工具。善用工具，往往可以达到事半功倍的效果。

**<a href="https://www.wbolt.com/tools/seo-topic?utm_source=wp&utm_medium=link&utm_campaign=bsl">5. SEO优化中心:</a>** 无论您是 SEO 初学者，还是想学习高级SEO 策略，这都是您的 SEO 知识中心。

**<a href="https://www.wbolt.com/tools/spider-tool?utm_source=wp&utm_medium=link&utm_campaign=bsl">6. 蜘蛛查询工具:</a>** 网站每日都可能会有大量的蜘蛛爬虫访问，或者搜索引擎爬虫，或者安全扫描，或者SEO检测……满目琳琅。借助我们的蜘蛛爬虫检测工具，让一切假蜘蛛爬虫无处遁形！

**<a href="https://www.wbolt.com/tools/wp-codex?utm_source=wp&utm_medium=link&utm_campaign=bsl">7. WP开发宝典:</a>** WordPress作为全球市场份额最大CMS，也为众多企业官网、个人博客及电商网站的首选。使用我们的开发宝典，快速了解其函数、过滤器及动作等作用和写法。

**<a href="https://www.wbolt.com/tools/robots-tester?utm_source=wp&utm_medium=link&utm_campaign=bsl">8. robots.txt测试工具:</a>** 标准规范的robots.txt能够正确指引搜索引擎蜘蛛爬取网站内容。反之，可能让蜘蛛晕头转向。借助我们的robots.txt检测工具，校正您所写的规则。

**<a href="https://www.wbolt.com/tools/theme-detector?utm_source=wp&utm_medium=link&utm_campaign=bsl">9. WordPress主题检测器:</a>** 有时候，看到一个您为之着迷的WordPress网站。甚是想知道它背后的主题。查看源代码定可以找到蛛丝马迹，又或者使用我们的小工具，一键查明。

== Installation ==

### 方式1：在线安装(推荐)

1. 进入WordPress仪表盘，点击 `插件-安装插件 `，关键词搜索 `多合一搜索自动推送 `，找搜索结果中找到"多合一搜索自动推送插件"，点击 `现在安装 `；
2. 安装完毕后，启用多合一搜索自动推送管理插件.
3. 通过`搜索推送-插件设置`进入插件设置界面，配置相关搜索引擎推送API接口或者JS代码.
4. 至此，该插件安装完毕。

### 方式2：上传安装

**FTP上传安装**

1. 解压插件压缩包baidu-submit-link.zip，将解压获得文件夹上传至wordpress安装目录下的 `/wp-content/plugins/`目录.
2. 访问WordPress仪表盘，进入 `插件-已安装插件`，在插件列表中找到多合一搜索自动推送插件，点击`启用`.
3. 通过`搜索推送-插件设置`进入插件设置界面，配置相关搜索引擎推送API接口或者JS代码.
4. 至此，该插件安装完毕。

**仪表盘上传安装**

1. 进入WordPress仪表盘，点击`插件-安装插件`；
2. 点击界面左上方的 `上传按钮`，选择本地提前下载好的插件压缩包baidu-submit-link.zip，点击 `现在安装`；
3. 安装完毕后，启用多合一搜索自动推送插件；
4. 通过`搜索推送-插件设置`进入插件设置界面，配置相关搜索引擎推送API接口或者JS代码.
5. 至此，该插件安装完毕。


关于本插件，你可以通过阅读<a href="https://www.wbolt.com/bsl-plugin-documentation.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="插件教程">多合一搜索自动推送管理插件教程</a>学习了解插件安装、设置等详细内容。

== Frequently Asked Questions ==

= 为什么360站长平台找不到推送JS？ =
360站长平台目前已经下线推送JS申请入口。

= 使用谷歌推送发生错误怎么办？ =
谷歌推送失败大部分原因是由于设置不当导致，建议您查看<a href=" https://www.wbolt.com/google-indexing-api-setting.html#comment-errors?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="常见错误及解决办法">常见错误及解决办法</a>。

= 我的网站不在国外，是否也可以使用谷歌推送？ =
只要您能够申请google index api密钥及访问Search Console进行相关设置（<a href="https://www.wbolt.com/google-indexing-api-setting.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="google index api申请及设置教程"> 设置教程</a>），谷歌索引推送都是没有问题的，因为推送是由插件提供的API完成。

= 为什么文章收录状态一直显示检测中？ =
由于百度搜索升级了非常复杂的验证码系统，暂不提供自动检测收录支持。

= 为什么百度实际未收录但插件显示已收录？ =
已收录但实际未收录，可能因为收录后被百度剔除。此种情况建议删除或者对内容整改。

= 为什么百度实际收录了但插件显示未收录？ =
长时间未收录文章建议对文章内容进行整改再次发布。部分已收录但显示未收录，需等待数据更新。

= 为什么百度推送状态为失败？ =
如果是快速收录推送失败，这一般是由于该域名无快速推送配额导致。如果是普通收录推送失败，则原因可能为：（1）服务器在国外或者香港；（2）没有百度快速推送配额;（3）域名不一致，或者协议不一致；（4）API填写错误。

= 插件自动推送数据统计与百度搜索资源平台后台统计不一致？ =
插件仅统计未推送过的自动推送数据，百度搜索资源平台后台则会重复计算，因此后者的统计数据会大于前者。但这不会影响正常的自动推送，两者均采用百度JS推送机制。

= 进入插件设置页面显示为空白，如何处理？ =
遇到这种情况，可能尝试以下解决方案：

- 清理网站缓存及浏览器缓存；
- 清里CDN缓存；
- 升级WordPress至最新版本，PHP升级至较新版本。如问题依然存在，通过闪电博官方提交工单联系获得技术支持。

= 为什么启用了死链检测设置，死链提交清单无数据展示？ =
遇到这种情况，应该首先去检查<a href="https://www.wbolt.com/plugins/spider-analyser?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="蜘蛛插件">Spider Analyser搜索引擎蜘蛛分析插件</a>是否安装启用；然后如果已安装启用Spider Analyser，可以通过WP后台-蜘蛛分析-蜘蛛日志，查看日志是否存在404状态链接，如无，则说明你网站不存在404死链。

= 为什么百度搜索资源平台提交sitemap推送提示“索引型不予以处理”？ =
由于百度搜索资源平台Sitemap处理规则发生了变化，参考<a href="https://www.wbolt.com/submit-sitemap-url-to-baidu.html?utm_source=wp&utm_medium=link&utm_campaign=bsl">非索引型sitemap提交教程</a>操作即可。

= 为什么百度收录统计与实际收录情况不符？ = 
由于不同地域不同时间不同客户端查询相同URL收录情况，可能结果不一致，因此文章百度收录状态仅供参考，实际收录情况以百度搜索为准。

= 插件设置提示“站点未在站长平台验证”，如何处理？ = 
出现这种情况一般是由于安装插件的网站域名地址与百度搜索资源平台的域名地址不一致导致。必须保证两边的协议头及域名都一致，即http或者https两边需一致，www或者无www两边需一致。

= 如何获取快速收录推送配额？ = 
目前仅优质内容网站，原来熊掌ID天级收录有配额或者提交小程序的网站具备快速收录配额。如果你网站对应的熊掌ID天级收录推送有配额，你可以申请快速收录推送集成这个配额，<a href="https://www.wbolt.com/how-to-get-baidu-quick-push-api-uota-from-xiongzhang-id.html?utm_source=wp&utm_medium=link&utm_campaign=bsl">查看教程</a>。

= 百度主动推送密钥在哪里获取？ = 
访问百度搜索资源平台获取准入密钥，<a href="https://www.wbolt.com/how-to-get-baidu-tokenid.html?utm_source=wp&utm_medium=link&utm_campaign=bsl" rel="friend" title="插件教程">查看详细教程</a>。

= 百度搜索资源平台普通收录推送密钥验证提示site sid is empty或者接口请求错误 =
这是百度搜索资源平台密钥验证服务器的问题。如提示site sid is empty或者接口请求错误时，点击重试或者稍后再试即可。尤其如果服务器在香港台湾或者境外地区，在请求百度搜索资源平台服务器时，很容易出现这个报错提示。

= 百度搜索推送插件推送设置推送提示超额 =
百度搜索资源平台目前URL更新/删除接口均无效，提示超额。如果你的百度搜索推送插件出现超额提示，请更新到插件最新版本，已经临时将URL更新和删除接口改为URL新增接口推送。

= 百度多合一搜索自动推送管理插件是否可以生成网站Sitemap? =
不会。使用插件的Sitemap推送功能，需依赖第三方Sitemap插件，推荐<a href="https://wordpress.org/plugins/smart-seo-tool/" rel="friend" title="SEO插件">Smart SEO Tool</a>或者Google XML Sitemaps，<a href="https://www.wbolt.com/how-to-set-google-xml-sitemaps.html?utm_source=wp&utm_medium=link&utm_campaign=bsl">阅读详细教程</a>。

= 是否使用了多合一搜索自动推送管理插件，即可保证百度搜索正常收录页面? =
不是的。多合一搜索自动推送管理插件仅是帮助站长将WordPress博客更新的内容快速推送给百度搜索，以便于百度搜索快速地发现URL。但百度搜索是否收录及收录时效，由百度决定。但可以肯定的是，该插件是有利于做百度搜索优化的。

= 为什么插件的收录统计与百度搜索引擎查询到的数据不一致？ = 
插件提供的百度收录统计数据为估算值，数据每小时更新一次。网站管理员如需了解更准确的索引量，请使用百度站长平台。

= 为什么Sitemap推送设置无法检测到Sitemap地址？ = 
我们兼容了大部分主流的sitemap插件，有可能无法检测一些插件生成的sitemap地址。也有可能你未安装sitemap插件或者无法检测到你所安装插件所生成的sitemap文件。

== Screenshots ==

1. 整站收录统计截图.
2. 搜索推送统计截图.
3. 百度收录统计截图.
4. 死链提交清单截图.
5. 搜索推送日志截图.
6. 插件设置界面截图.
7. 版本功能对比截图.

== Changelog ==

= 4.2.11 =
* 修复定时发布文章推送异常bug；
* 修复部分场景重复推送bug；
* 修复域名或者服务器更换无法激活插件的bug。

= 4.2.10 =
* 修复推送助手无法下载的bug。

= 4.2.9 =
* 插件代码规范：基于 PHP 和 WordPress 代码规范进一步优化核心PHP文件。
* 优化插件性能：使用预准备语句 $wpdb->prepare 来准备 SQL 查询。
* 增强插件安全：在输出 HTML 的数据时使用 esc_attr(), esc_html() 等安全函数；避免直接使用 $_GET 和 $_POST 中的数据，而应先进行验证。

= 4.2.8 =
* 增强nonce验证安全策略；
* 调整优化部分PHP代码；
* 完善许可证校验逻辑。

= 4.2.7 =
* 增强插件代码安全。

= 4.2.6 =
* 增加nonce安全校验以保证插件安全。

= 4.2.5 =
* 更新Bing推送API接口。

= 4.2.4 =
* 修复推送日志标签切换数据读取失败bug。

= 4.2.3 =
* 修复谷歌索引API密钥配置JSON代码保存丢失bug；
* 修复头条推送JS代码保存丢失bug；
* 新增和优化部分温馨提示文字内容。

= 4.2.2 =
* 新增bing收录量查询api支持；
* 丰富插件温馨提示内容，以帮助站长更好地理解和使用插件；
* 优化整站收录统计表及趋势图，同时支持不同时间维度百度和bing收录数统计、周期对比及走势图；
* 优化插件后台UI及交互体验。

= 4.2.1 =
* 新增死链清单文件导出支持；
* 新增推送报错解决办法快捷入口；
* 新增收录统计图表不同文章类型筛选支持；
* 下架360推送和神马推送JS支持；
* 修复部分网站闪电博助手下载链接404错误；
* 优化新发布文章推送效率问题。

= 4.2.0 =
* 新增闪电博助手浏览器扩展支持，支持快速获取最新链接数据手动推送至头条、搜狗和360站长工具后台；
* 优化插件执行日志功能模块，改名为执行&错误日志，并对免费版本开放；
* 优化错误代码说明，以帮助站长更好地理解和解决推送错误。

= 4.1.1 =
* 新增回调URI以便于站长快速复制填写至Yandex应用配置页面；
* 修复Yandex推送返回400错误bug;
* 修复Yandex推送返回202状态注释不正确bug。

= 4.1.0 =
* 新增IndexNow推送API支持；
* 新增Yandex推送API支持；
* 新增IndexNow和Yandex推送统计及日志等功能；
* 将推送API分为核心推送，海外推送及普通推送三组；
* 已知若干小问题修复。

= 4.0.9 =
* 紧急修复百度快速收录推送无法开启bug。

= 4.0.8 =
* 兼容WordPress 6.0；
* 修改更新提示点击无效bug；
* 增加快速收录推送开启提示；
* 下载百度收录检测API相关；
* 完善部分功能文字描述或者使用说明。

= 4.0.7 =
* 下线360批量推送功能支持；
* 新增死链提交清单伪蜘蛛检测过滤支持；
* 新增死链提交清单文件自动分拆支持；
* 新增死链批量刷新状态支持；
* 支持不同文章类型批量推送百度选项；
* 修复百度收录列表无法批量推送百度bug；
* 优化百度推送接口判断，接口网址无协议时不进行校对；
* 修复强推无日志bug。

= 4.0.6 =
* 新增百度推送API地址空格检测删除支持；
* 补充部分功能的说明文字以便于用户更好地使用插件。

= 4.0.5 =
* 兼容WordPress 5.9；
* 新增百度收录统计列表强推百度操作选项；
* 新增强推百度日志记录；
* 优化死链检测操作交互体验；
* 优化插件移动端样式及交互体验。

= 4.0.4 =
* 修复设置界面因文件写入权限导致异常的问题。

= 4.0.3 =
* 优化百度收录查询默认选项为关闭；
* 优化百度推送API协议检查逻辑，网站推送API无协议时不检查；
* 其他已知问题修复。

= 4.0.2 =
* 基于WordPress安全规范整理代码；
* 新增百度搜索资源平台推送api匹配检测；
* 新增收录状态状态“检测关闭”；
* 优化推送代码保存方式以防止被拦截；
* 修复主动检测采集入库文章推送失效bug。

= 4.0.1 =

* 优化谷歌推送删除推送逻辑；
* 优化移动端表单UI样式；
* 修复旧文章更新占用快速推送配额bug；
* 其他已知UI样式及用户体验优化。

= 4.0.0 =

* 新增谷歌索引推送统计；
* 新增谷歌索引推送日志；
* 新增谷歌index api配置；
* 修复部分网站无法保存360和头条推送js代码bug。

= 3.4.19 =
* 新增百度推送链接完整性检测以免百度抓取失败；
* 优化百度收录概况数据查询逻辑；
* 完善部分功能文字描述或者使用说明。

= 3.4.18 =
* 解决百度收录总数查询异常问题；
* 新增百度普通收录推送（强制推送）支持及数据和日志统计；
* 新增百度收录手动标记功能支持；
* 新增百度收录统计、死链提交清单列表批量操作支持；
* 优化列表单页显示项目数量可选。

= 3.4.17 =
* 新增API推送选项，支持旧文章快速推送及自动检测采集文章推送开关；
* 新增部分状态说明文字，以帮助站长更好地理解；
* 新增Pro版本升级入口链接；
* 新增限时优惠活动入口；
* 优化百度普通推送与快速推送间的推送逻辑；
* 优化收录查询API查询逻辑，使网站队列更加科学合理；
* 优化版本升级提示与WordPress默认样式一致。

= 3.4.16 =
* 新增神马和头条推送、统计&日志功能；
* 新增头条批量推送支持；
* 360推送、神马推送和头条推送统计图表合并为一个图表；
* 推送日志列表增加Tab标签筛选支持；
* 移动端细节优化。

= 3.4.15 =
* 修复插件推送API设置无法保存数据的bug；
* 修复死链清单txt文件无法访问的bug；
* 修复部分sitemap地图无法检测的bug。

= 3.4.14 =
* 插件引入全新框架，提升插件性能；
* 优化插件数据读取及日志性能；
* 优化插件底部推荐模块展示样式；
* 文章收录清单列表变更为百度收录统计；
* 百度收录统计增加数据概要及收录分布图表；
* 优化搜索推送统计图表样式及排版；
* 优化整站收录统计数据计算方式及增加文章收录数据项；
* 修复整站收录统计表纵坐标刻度数值显示不全bug；
* 解决整站收录统计表数据异常问题；
* 修复百度快速推送数量超出配额值bug；
* 引入全新的表格UI组件库；
* 其他已知问题及bug修复，用户体验优化等。

= 3.4.13 =
* 修复360推送日志无法启用bug;
* 修复360推送JS报错问题。

= 3.4.12 =
* 重新设计插件Logo，以更符合插件特性；
* 新增360批量自动推送，实现post页面访问批量推送站点域名链接数据；
* 优化插件PC端和移动端界面交互UI；
* 下线百度普通收录自动推送功能及数据统计。

= 3.4.11 =
* 插件管理界面重构，按核心功能拆分多页面，小功能拆分多标签页；
* 新增360搜索自动推送JS；
* 百度自动推送JS下线；
* 新增360搜索推送数据统计及日志；
* 优化数据统计图表UI。

= 3.4.10 =
* 修复百度普通收录推送统计数据无显示bug；
* 优化数据统计图表样式。

= 3.4.9 =
* 新增日志保留时间，支持按24小时、3天或者7天保留日志数据；
* 新增日志列表一键清除功能；
* 优化数据统计图表外观样式；
* 优化百度自动推送数据统计取值方法；
* 百度普通收录及快速收录推送日志合并为百度推送日志；
* Bing自动推送和手动推送日志合并为Bing推送日志；
* 百度普通收录和快速收录推送数据统计合并为百度推送统计。

= 3.4.8 =
* 修复死链提交清单无法正常显示bug；
* 优化百度推送设置推送方式选项移动端显示样式。

= 3.4.7 =
* 新增文章URL地址蜘蛛爬取历史查询功能；
* 优化百度推送API接口调用地址设置，普通收录和快速收录API地址选其一填入即可；
* 简化插件设置选项，整合多个百度收录推送方式为相同设置选项，以便于站长更好理解和设置。

= 3.4.6 =
* 紧急修复JS未压缩导致死链忽略功能报错bug。

= 3.4.5 =
* 新增死链提交清单忽略操作项；
* 优化Bing手动推送日志刷新机制；
* 优化整站收录统计查询异常（查询失败或者更新失败）数据保存方式；
* 解决网站404状态链接过多导致插件报错的问题；
* 其他已知小问题优化。

= 3.4.4 =
* 重新上线百度普通收录的自动推送功能；
* 恢复百度普通收录的自动推送数据统计；
* 恢复百度普通收录自动推送开关功能；
* 优化整站收录统计升级Pro版本提示逻辑。

= 3.4.3 =
* 新增百度收录概况API接口，Pro版本用户使用API接口查询百度收录概况（本地服务器无法查询数据的情况下）；
* 新增当前站点已完成的文章百收录查询次数显示；
* 优化百度推送日志&Bing推送数据页面，无数据时显示“最近7天无推送数据，建议保持每日更新内容”；
* 优化Bing推送设置已关闭手动推送，对应Bing手动推送功能界面不关闭bug。

= 3.4.2 =
* 优化Bing推送功能部分文字说明；
* 修复free版本Bing站长平台API密钥无法填入bug;
* 修复移动端Bing推送日志无数据展示bug。

= 3.4.1 =
* 紧急修复无法保存bug.

= 3.4.0 =
* 新增Bing推送统计功能；
* 新增Bing自动推送功能；
* 新增Bing手动推送功能；
* 新增版本升级提醒功能；
* 优化收录查询API链接更新功能；
* 优化百度收录查询规则，超长URL及长期未收录URL不再执行查询。

= 3.3.1 =
* 优化移动端插件设置界面加载性能；
* 修复PHP版本兼容问题；
* 修复插件数据库查询表前缀bug；
* 修复插件免费版本收录趋势未收录文章可显问题。

= 3.3.0 =
* 新增死链提交清单功能，支持搜集网站404死链数据及数据列表下载；
* 新增404死链检测设置开关功能，支持联调Spider Analyser插件获取404死链数据；
* 修复百度收录概况查询失败数据显示为0的bug；
* 优化检测中状态，仅针对新发布文章有效。

= 3.2.9 =
* 新增文章收录清单收录“未检测”状态项；
* 新增推送文章类型说明文字；
* 新增百度收录数据判断规则；
* 优化百度搜索引擎全站收录量查询频率及数据取值规则；
* 优化插件部分术语名称；
* 优化收录趋势图表的未收录文章数据取值；
* 优化数据图标纵坐标参考值；
* 优化全量数据检测次数，限每个网站全量检测一次；
* 修改sitemap推送说明，提示非索引型sitemap提交；
* 删除旧版本不必要的代码，压缩插件体积；
* 修复其他已知bug。

= 3.2.8 =
* 修复手机端文章收录清单默认不加载数据bug；
* 修改手机端文章收录清单默认选项为全部文章；
* 针对百度搜索新验证码规则优化百度收录文章查询API；
* 优化百度收录查询API查询机制，降低长时间未收录文章查询频次。

= 3.2.7 =
* 下架自动推送功能（百度搜索资源平台已取消该推送方式）；
* 下架天级收录相关功能（天级提交已于5月18日暂停使用）；
* 优化百度收录状态查询API，提升查询效率；
* 优化百度收录状态查询默认状态为关闭；
* 优化激活码获取窗口样式；
* 修复插件执行日志移动端无显示bug；
* 修复快速收录推送开关Free版本可开启bug；
* 修复收录状态查询启用后无法关闭bug；
* 取消快速收录推送启用弹窗提示。

= 3.2.6 =
* 优化文章收录查询规则，发布时间超过1年的不再重复查询收录状态，提升API查询效率；
* 优化文章收录查询频率，调整周期为2天；
* 修复SQL语法错误导致数据库建表失败的bug。

= 3.2.5 =
* 新增百度快速收录接口地址校验；
* 优化插件执行日志功能，支持输出更多日志以便排查插件问题；
* 优化插件执行日志展示，移至相关日志版块及以采用更容易阅读样式；
* 优化文章百度收录查询机制，提升查询效率及准确度。

= 3.2.4 =
* 新增插件日志功能；
* 新增文章百度收录状态查询API功能，以API查询替代原有的本地服务器查询方式；
* 新增手动执行网站百度收录概况查询；
* 优化文章收录状态查询规则，提高查询频率保证数据及时性。

= 3.2.3 =
* 新增文章不执行快速（天级）推送设置功能。
* 优化百度收录检测方法采用api对接专用服务器检测，提高检测效果及成功率；
* 优化推送规则，密码保护类型文章设为例外列表；
* 优化插件性能，部分非关键性数据采用异步加载以提升插件加载速度。

= 3.2.2 =
* 修复百度收录查询导致定时任务数量过多的bug.

= 3.2.1 =
* 优化插件设置界面移动端兼容性；
* 修正快速收录及天级收录推送设置API地址说明错误。

= 3.2.0 =
* 新增快速收录推送数据统计功能；
* 新增快速收录推送日志功能；
* 新增快速收录推送接口设置功能；
* 新增快速收录推送提换为天级收录推送功能，支持站长快速将天级收录推送切换为快速收录推送。

= 3.1.1 =
* 修复最近30天收录数据异常bug；
* 优化收录清单“检查收录”功能为跳转窗口查询（原为js查询，由于百度防爬虫机制该方法比较容易报错）；
* 取消文章管理列表的“检测百度收录状态”入口；
* 优化文章管理列表百度未收录/百度已收录链接为百度查询链接；
* 优化未收录文章列表操作项，新增“提交链接至百度”，支持站长手动提交未收录链接至百度。

= 3.1.0 =
* 新增收录清单功能，支持快速查看整站收录及未收录文章数据；
* 基于百度最新业务调整，取消周级推送相关功能；
* 优化收录概况功能，取消当天收录统计及加入最近30天收录统计；
* 优化数据说明及功能提示文字，提升用户使用效率；
* 取消推送日志的收录状态，以收录清单功能代替；
* 优化插件加载性能，进一步提升用户体验；
* 优化百度收录查询功能，提升收录状态准确度。

= 3.0.4 =
* 修复周级推送重复推送相同URL地址问题；
* 增加WordPress插件安全性校验；
* 兼容低版本PHP，修复语法错误报错bug。

= 3.0.3 =
* 修复插件部分条件下熊掌ID天级推送配额读取及推送异常问题；
* 优化移动端图表数据展示样式；
* 优化数据图表纵坐标数据超过1000时以K为单位。

= 3.0.2 =
* 修复熊掌ID周级每周定时任务失败bug；
* 修复熊掌ID天级推送异常bug；
* 优化插件图表数据&样式加载性能。

= 3.0.1 =
* 修复新安装插件主动推送密钥默认值；
* 修复动态链接推送bug；
* 修复熊掌ID天级推送配额为0问题；
* 修复Pro版本设置开关默认开启问题；
* 修复其他已知bug及体验问题。

= 3.0.0 =
* 全新功能模块分组，数据统计/推送日志/插件设置三大功能模块；
* 全新数据图表设计，支持按数据类型及时间维度查看数据走势；
* 新增收录统计-收录概况，方便站长快速查看收录总数、当天收录及近7天收录数据；
* 新增收录统计-收录明细，支持查看最近7天及30天的收录总量/新增收录/未收录文章数据走势；
* 新增日志功能，支持查看最近7天的主动推送、天级推送及周级推送日志(时间/链接/推送状态/收录状态)；
* 新增免费版本&Pro版功能对比清单及Pro版本功能可视化功能，便于免费版本用户快速了解Pro功能；
* 新增存量未收录文章使用周级推送规则；
* 优化Sitemap地址检测规则，兼容All in One SEO Pack, Yoast SEO, SEOPress和Google XML Sitemaps等主流插件生成sitemap文件检测；
* 优化部分插件功能说明、注意事项及使用教程等文字内容；
* 优化数据统计图表样式，由柱状图改为折线图；
* 优化主动推送数据统计图表，加入自动推送数据统计.

= 2.1.7 =
* 解决部分自动发布文章插件下无法执行天级推送问题

= 2.1.6 =
* 优化插件设置界面部分样式
* 增加插件日志（方便排查插件问题）及手动执行统计功能
* 其他已知小bug修复

= 2.1.5 =
* 新增文章类型选择，支持推送更多文章类型（包括文章、页面、媒体及自定义类型）；
* 进一步修复主动推送会推送草稿（未发布内容）bug；
* 修复插件冲突call to member function has_cap() on null报错。

= 2.1.4 =
* 优化百度搜索资源平台自动及主动推送JS，防止百度爬虫对草稿文章的抓取

= 2.1.3 =
* 进一步优化百度收录检测功能

= 2.1.2 =
* 优化交互细节

= 2.1.1 =
* 百度搜索资源平台接口请求超时优化
* 优化域名验证规则
* 修复数据统计负数结果

= 2.1.0 =
* 新增百度已收录/未收录文章查询功能（PRO）
* 修复已知若干bug

= 2.0.0 =
* 新增百度熊掌号天级推送及数据统计功能（PRO）
* 新增百度熊掌号周级推送及数据统计功能（PRO）
* 新增网站文章百度收录情况查询功能（PRO）

= 1.2.0 =
* 新增推送日志功能
* 修复推送数据统计bug
* 修复百度搜索资源平台密钥验证bug

= 1.1.1 =
* 优化百度推送规则，由定时推送改为实时推送

= 1.1.1 =
* 优化URL更新/删除推送改用URL推送接口（百度搜索资源平台目前URL更新/删除接口均无效，提示超出限额）

= 1.1.0 =
* 增加插件教程/插件支持等链接入口
* 优化插件设置UI界面

= 1.0.1 =
* 修复推送结果类型
* 修复php低版本无法工作的问题

= 1.0.0 =
* 新增百度搜索自动推送功能
* 新增百度搜索sitemap推送功能
* 升级百度搜索主动推送功能，实现推送数据记录及报错日志提示
* 插件设置界面UI采用更规范统一的设计
# analytics-embed

Google Analytics Embed API サンプル。    
Google Analytics のデータ取得とグラフ化を一度に実装してくれるのが特徴です。

参照：https://developers.google.com/analytics/devguides/reporting/embed/v1/?hl=ja

## index.php

ベーシックな折れ線グラフ。

* 過去1週間のセッション数

![](https://github.com/syake/analytics-embed/blob/master/assets/index.png)

## third_party.php

基本のデザインとは少し違うもので円グラフやアニメーションなども実装されています。

* 過去1週間のセッション数
* 1年間の訪問ユーザー数
* ブラウザごとのページビューを円グラフで表したもの
* 国ごとのセッション数を円グラフで表したもの

![](https://github.com/syake/analytics-embed/blob/master/assets/third_party.png)

## auth.php

サーバー側のauth認証を使って、認証ボタンの確認なしでデータを取得できるサンプル。    
サービスアカウントの取得や認証用のJSONキーが必要になります。

* データ取得の期間を指定
* セッション数と訪問ユーザー数とページビューの折れ線グラフ
* ページごとのセッション数
* 年齢別のセッション数  
（ユーザーの分布レポートを有効化する必要があります）
* 地域ごとのセッション数を日本地図上で表したもの  
（ユーザーの分布レポートを有効化する必要があります）

![](https://github.com/syake/analytics-embed/blob/master/assets/auth.png)

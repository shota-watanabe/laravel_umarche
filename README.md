## マルチログイン機能を構築した本格的なECサイト
# [laravel_umarche](http://umarche0920.net)
## サービス概要
Laravelが搭載している認証機能を活用し、管理者、オーナー、ユーザーと3つのログイン情報を持たせた本格的なECサイトです。

Udemyの[【Laravel】マルチログイン機能を構築し本格的なECサイトをつくってみよう](https://www.udemy.com/course/laravel-multi-ec/)で作りました。

会員登録ページから新規会員登録もできますが、ひとつこちらでアカウントを用意しました。  
ログイン画面でゲストログインボタンを押すと、メールアドレスとパスワードを打たなくても、簡単にテストユーザーとしてログインできます。  

ゲストログインで使用しているアカウントはこちらになります。  
【ユーザー】
メールアドレス：`test@test.com`　　　パスワード：password1234  
【オーナー】
メールアドレス：`test1@test.com`   　　パスワード：password1234  
【管理者】
メールアドレス：`admin@admin.com`   　　パスワード：password1234  
## 使用画面  

<img width="1024" alt="user:home" src="https://user-images.githubusercontent.com/34031637/134280413-0b32a901-1421-49ba-bae7-33f251fdef1c.png">
<img width="700" alt="mail" src="https://user-images.githubusercontent.com/34031637/134280637-73554bc0-20ec-4014-8ddc-4dd03b304e8c.png">

## ER図

<img width="1024" alt="メモ3" src="https://user-images.githubusercontent.com/34031637/134279636-e2450edd-5191-43ef-a5fe-8a01283a3b23.png">

## 基本機能
- 会員登録（メールアドレスとパスワードで登録）
- マルチログイン、ログアウト
- ユーザー
    - 商品検索（カテゴリーによる絞り込み、キーワード検索）
    - カート（買い物カゴ）
    - 商品の決済（Stripeライブラリを使用。ダミーのクレジットカードを使ったテスト決済になります）
- オーナー
    - 店舗情報の管理
    - 画像管理
    - 商品管理
- 管理者
    - オーナー管理
- 商品購入時のメール送信（MailTrapライブラリを使用。ユーザー向け、オーナー向けに送信しています）
- リレーショナル・データベースの基本機能（作成、編集、削除、一覧、詳細）
- レスポンシブデザインによるスマートフォン対応　　
## 追加機能
- ゲストログイン 
- ユーザーメニューからユーザー、オーナー、管理者を切り替え可能にした
- パスワードリセット時のメール送信（ユーザーのみ。MairTrapライブラリを使用）
- 画像アップロード時の保存先をAWS S3に変更
- 店舗の新規登録
- 商品のお気に入り登録、一覧表示（ほしいものリストのような感じです。）
## 工夫しているところ
- N+1問題の対策  
Eager Loadingを実装  
→エロクアントにwithメソッド、リレーションをドットでつないでいくことで、クエリの発行回数を減らしパフォーマンスを向上させています。　　
- 非同期処理  
メール送信処理を裏側でするために、キュー、ジョブ、ワーカーを使い非同期として処理しています。  
それによって、画面更新の時間が短縮され、ユーザーのストレスを軽減させています。
## 不具合およびその対処法（対策判明次第、修正します）
- 画面右上のユーザーメニューでオーナーや管理者などを切り替え、ログインしたときに、別のガードでログインしてしまう現象が起きる  
例）ユーザー→オーナー→ユーザーとログインしたときに、ログイン時の遷移先はユーザーのホーム画面になるが、ナビゲーションメニューはオーナーのものになる。
    - 暫定対応  
例の場合、もういちどユーザーとしてログインする  
- 商品登録時にimage１〜３を選んだ後にimage4を選ぶと、以前に選んだimage１〜３のモーダルが開く
    - 暫定対応  
image5を作成し、Controller側ではimage４まで保存対象とする（image5は飾りです）
## 使用技術
- PHP 7.4
- Laravel8
- MySQL5.7
- html
- talwindcss
- bootstrap
- JavaScript
- AWS
    - VPC
    - EC2
    - RDS
    - Route53
    - S3

# Hamburger Classic テーマ

クラシックエディタ向けに最適化された WordPress テーマです。検索フォーム、カードレイアウト、ヒーローセクション、メニューアーカイブなどを備え、ハンバーガーショップの LP / ブログをすぐに構築できます。

## 主な特徴

- レスポンシブ対応（SP / タブレット / PC のブレークポイントを SCSS ミックスインで管理）
- 投稿アーカイブを `/menu/` スラッグで公開するカスタマイズ
- 空欄検索時のトップページリダイレクト、投稿タイプを `post` のみに限定した検索
- サイドバー／フッターのカスタムウォーカーメニューと専用クラス付与
- SCSS に FLOCSS 設計（foundation / layout / object / utility）

## ディレクトリ構成

```
wp-content/themes/hamburger-classic/
├── css/              # 出力されたCSS（手動で編集しない）
├── js/main.js        # 画面内インタラクション
├── picture/          # テーマ同梱画像
├── scss/             # 設計ベースのSCSSソース
├── *.php             # WordPress テンプレート
└── README.md
```

## セットアップ手順

1. リポジトリ全体を `wp-content/themes/hamburger-classic` に配置
2. WordPress 管理画面の「外観 > テーマ」で _Hamburger Classic_ を有効化
3. メニューを作成し、以下のロケーションに割り当て
   - `sidebar-menu`：サイドバー表示用
   - `footer-menu`：フッターリンク表示用
4. 固定ページ「ホーム」をフロントページに設定（必要に応じて ID やスラッグを `functions.php` と揃える）
5. 画像／テキストを php ファイルや管理画面から更新 固定ページヒーロー画像は ACF を利用

## WordPress カスタマイズ

- `functions.php`
  - `hamburger_title()` でフロントページとシングルのタイトル制御
  - `my_post_search()` / `empty_search_redirect()` で検索体験を改善
  - `custom_walker_nav_menu` / `custom_walker_nav_footermenu` で HTML 構造を固定
  - `add_span()` により特定ページの `<h2>` タグへ `<span>` を自動挿入
- `front-page.php` / `archive.php` / `search.php` などテンプレートを用途別に用意済み

## 画像・アセット

`picture/` 配下にヒーロー画像やテクスチャ素材を配置しています。差し替える場合は同名ファイルで置換するか、SCSS/テンプレート側のパスを変更してください。

## プラグイン

- Advanced Custom Fields
- All-in-One WP Migration and Backup
- Classic Editor
- UpdraftPlus
- WordPress インポートツール
- WP-PageNavi
- セキュリティ用プラグイン
- 自動キャッシュクリアプラグイン

## テスト

テーマの性質上、自動テストは含みません。以下を手動確認することを推奨します。

- フロントページ、アーカイブ（`/menu/`）、検索結果、404 ページ
- メニューやリンクの動作
- レスポンシブ表示（SP / タブレット / PC）

---

# yamaaaaaa/wareki 

Japanese Era Date Utility  
It is used in the same way as cabon.

日本の元号ユーティリティー Carbonをラップしています。
次のフォーマットを追加で利用できます。

| フォーマット | 出力例  | 備考                                  |
|--------|------|-------------------------------------|
| ERA    | 令和5年 | ※1年は元年と表記、重複の場合は併記<br>例）令和元年(平成31年) |
| ERA_NAME    | 令和   |                                     |
| ERA_SHORT    | R    |                                     |
| ERA_YEAR    | 5    |                                     |


## hot to use

```
$wareki = new Wareki();
$formated = $wareki->format('ERA');
var_dump($formated);
>>string(10) "令和6年"
```

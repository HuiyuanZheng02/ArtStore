# Art-Store
An art trading website using the most basic HTML, CSS, JS, PHP, MySQL language and database.

SOFT130071.01 - 2022 Spring  
复旦大学 - 卓越软件开发基础 ｜ Fudan University - Outstanding Ability of Software Development (Basic)  

## 项目要求
[要求文档](https://github.com/HuiyuanZheng02/ArtStore/blob/main/%E6%96%87%E6%A1%A3/%E5%8D%93%E8%B6%8A%E8%BD%AF%E4%BB%B6%E5%BC%80%E5%8F%91%E5%9F%BA%E7%A1%80%20Project%20%E8%89%BA%E6%9C%AF%E5%93%81%E7%BD%91%E7%AB%99.pdf)  
本次课程 Project 的目标是设计并实现一个艺术品交易网站的前端与后端，即网站的界面以及其后 台的数据交互和运作逻辑。简单概括，可以分为一下几个页面与功能:首页、搜索、用户登录、用 户注册、商品详情、个人中心、购物车、发布与修改。

#### 语言与框架选择
使用最基础的 HTML、CSS、JS、PHP、MySQL 语言与数据库完成本次项目，禁止使 用如 Bootstrap 等相关的 UI 框架库来实现，也禁止通过嵌入数张图片(类似于网页截图)的方式 完成整个页面的构建。

#### 整体视觉要求
- 网站应存在合理的布局与适当的装饰。
- 网站可以使用中文或是英文进行编写，但不建议出现大量的中英文混搭。
- 各按钮最好有相应的图标，鼠标滑过按钮或链接应有一定的样式变化。
- 网站各组件排版、样式除非有特殊说明，否则形式不限，自由发挥即可。

#### 代码风格
使用原生 HTML、CSS、JS 时，应做到页面、样式、脚本的分离，不允许把一个页面的所有代码都 写在同一个文件内。
代码有适当的注释、缩进及空格。  
外部资源的引用应使用相对路径而不是绝对路径。

## 项目实现
[项目说明文档](https://github.com/HuiyuanZheng02/ArtStore/blob/main/%E6%96%87%E6%A1%A3/Project%E8%AF%B4%E6%98%8E%E6%96%87%E6%A1%A3.pdf)  
**开发环境：** PHP 5.6 / Phpstorm / macOS 12.4
**运行环境：** 各主流浏览器

#### 用例图
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236732300-0436593b-6495-4bc3-b32b-90f8c22d09c2.png">

#### 类图
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236732330-1cfbc8e1-41db-4e43-8675-6c9a9a32c05a.png">

#### 状态机图
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236732354-f9f1bbc9-1e63-468f-b234-7072f3d3754c.png">

#### 流程图
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236732369-e6e1bc8f-45c9-4907-a959-15dc26bef756.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236732396-161769f6-2d34-4036-9fd5-d8ab587cf916.png">

#### 页面截图

##### 1. 主页
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236755795-8635c17b-8d5e-4e60-a95a-aa77c5b2180a.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236755819-673a3015-0f50-44c0-ac8a-e0672aed0bb7.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236755835-f592789f-5789-47d4-a23e-bb2c310fd58e.png">

##### 2. 登陆/注册
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236755993-a036ddf9-b7bd-4ad1-a9c1-04f395844e0e.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756027-c68548ca-2309-4da0-9649-0650593c1b70.png">

##### 3. 商品详情
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756104-b6033717-df48-476a-bde1-b3d1b4cd0feb.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756116-14f482bc-9a0e-4630-975d-32647aa3bf1a.png">

##### 4. 发布/修改
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756188-79ff9ee3-5789-44c0-bcb2-f788dbb63d6e.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756209-67977b86-32fb-42a1-981b-b11e6ccebd4f.png">

##### 5. 购物车
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756253-fd7add64-834c-4d62-9e0d-d3c61736bb16.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756269-7e73a7ce-5df0-46ee-9112-d8c71edfecd4.png">

##### 6. 个人中心
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756321-aa0f5ca7-aea4-4573-a930-1bbf0fdcd8ff.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756340-b5915cfc-bffc-4ae2-bbbd-41bc297d9d48.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756360-d5e49290-bdf6-47b1-8e5c-0792554f0d66.png">
<img width="416" alt="image" src="https://user-images.githubusercontent.com/99488496/236756372-6d59bf49-d9b3-4c25-8cfc-922debe83e39.png">

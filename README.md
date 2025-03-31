# Get-ali-access-token
<p>Get-ali-access-token</p>
<p>1.https://open-api.alibaba.com/oauth/authorize?response_type=code&client_id=appkey&redirect_uri=https://www.alibaba.com&state=alibaba</p>
<p>get code</p>
<p>2.</p>
<p>python Get-ali-access-token.py</p>
<p>get access-token</p>
<p>✅ 步骤一：拼接授权链接</p>
使用以下格式拼接你的授权 URL：
https://open-api.alibaba.com/oauth/authorize?response_type=code&client_id=你的AppKey&redirect_uri=你的回调地址&state=xyz
示例（请替换成你的）：

https://open-api.alibaba.com/oauth/authorize?response_type=code&client_id=507788&redirect_uri=http://localhost:8080&state=alibaba
<p>✅ 步骤二：在浏览器中访问链接，登录并授权</p>
用商户账号登录阿里巴巴国际站。

会跳转回你的 redirect_uri，并携带 ?code=xxx 参数。

复制这个 code，下步用。

<p>✅ 步骤三：用 code 换取 access_token</p>
调用 https://open-api.alibaba.com/rest/auth/token/create 接口。

你可以用这个 Python 脚本快速完成：


{
  "access_token": "50000000abcde...",
  "refresh_token": "50000000xyz...",
  "expires_in": 25920000,
  "refresh_expires_in": 25920000,
  ...
}
<p>✅ 步骤四：复制 access_token 更新到 .env</p>

ALIBABA_ACCESS_TOKEN=你的新token
然后你就可以正常调用阿里 API 了！


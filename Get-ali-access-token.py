import os
import time
import hashlib
import hmac
import requests
from urllib.parse import quote

APP_KEY = "567784"
APP_SECRET = "cfcd71gtrfhfedhc2587b67ecabfad61"
CODE = "3_567784_wm3SOl9zyhefhPIYFtHpmR5r3"
API_URL = "https://open-api.alibaba.com/rest/auth/token/create"

def get_timestamp():
    return str(int(time.time() * 1000))

def generate_signature(params, secret):
    sorted_items = sorted(params.items())
    concat_str = "/auth/token/create" + "".join(f"{k}{v}" for k, v in sorted_items)
    return hmac.new(secret.encode(), concat_str.encode(), hashlib.sha256).hexdigest().upper()

def get_token():
    timestamp = get_timestamp()
    params = {
        "app_key": APP_KEY,
        "code": CODE,
        "sign_method": "sha256",
        "simplify": "true",
        "timestamp": timestamp
    }
    sign = generate_signature(params, APP_SECRET)
    params["sign"] = sign

    url = API_URL + "?" + "&".join(f"{k}={quote(str(v))}" for k, v in params.items())
    res = requests.post(url, headers={"Accept-Encoding": "gzip"})
    print(res.json())

get_token()
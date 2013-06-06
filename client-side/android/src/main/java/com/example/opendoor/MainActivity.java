package com.example.opendoor;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.protocol.HTTP;
import org.apache.http.util.EntityUtils;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import android.os.Bundle;
import android.app.Activity;
import android.app.ActivityManager;
import android.app.ActivityManager.RunningAppProcessInfo;
import android.content.Context;
import android.telephony.TelephonyManager;
import android.view.Menu;
import android.view.View;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends Activity {

    private Button mButton1;
    private WebView mWebView;
    private final String mUrl = "http://door.ckopenlab.com/open/";
    private String mDeviceId;
    private String uriAPI;
    private boolean isActive = true;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        mButton1 = (Button)findViewById(R.id.button1);
        mWebView = (WebView)findViewById(R.id.webView1);

        mDeviceId = getMyDeviceId();
        uriAPI = mUrl+mDeviceId;

        sendMsg();

        mButton1.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                sendMsg();
            }
        });

    }

    public String getMyDeviceId() {
        TelephonyManager mTeMa = (TelephonyManager) this.getSystemService(Context.TELEPHONY_SERVICE);
        String deviceId = mTeMa.getDeviceId();
        return deviceId;
    }

    public void sendMsg() {
        try {

            mWebView.loadUrl(uriAPI);
        } catch(Exception e) {}
    }


    @Override
    protected  void onStop() {
        super.onStop();
        if (!isAppOnForeground())
        {isActive = false;}
    }


    @Override
    protected void onResume() {
        super.onResume();
        if (!isActive) {
            sendMsg();
            isActive = true;
        }

    }

    public boolean isAppOnForeground() {
        // Returns a list of application processes that are running on the
        // device

        ActivityManager activityManager = (ActivityManager) getApplicationContext().getSystemService(Context.ACTIVITY_SERVICE);
        String packageName = getApplicationContext().getPackageName();

        List<RunningAppProcessInfo> appProcesses = activityManager
                .getRunningAppProcesses();
        if (appProcesses == null)
            return false;

        for (RunningAppProcessInfo appProcess : appProcesses) {
            // The name of the process that this object is associated with.
            if (appProcess.processName.equals(packageName)
                    && appProcess.importance == RunningAppProcessInfo.IMPORTANCE_FOREGROUND) {
                return true;
            }
        }

        return false;
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

}

package parser;

import java.io.IOException;
import java.io.InputStream;
import java.net.MalformedURLException;
import java.net.URL;

import org.json.JSONObject;
import org.json.XML;


public class Xml2GeoJSON {

	public Xml2GeoJSON() {
		try {
			String str = "http://maps.google.com/maps/api/geocode/xml?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=true";
			URL url = new URL(str);
			
			InputStream is = url.openStream();
			int ptr = 0;
			StringBuilder builder = new StringBuilder();
			while ((ptr = is.read()) != -1) {
			    builder.append((char) ptr);
			}
			String xml = builder.toString();
			
			//convert XML to JSONObject
			JSONObject jsonObject = XML.toJSONObject(xml);
			System.out.println(jsonObject);
		} 
		//new URL()
		catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		//URL.openStream()
		//InputStream.read()
		catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}

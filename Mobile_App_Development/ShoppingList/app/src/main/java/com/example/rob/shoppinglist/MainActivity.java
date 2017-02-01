package com.example.rob.shoppinglist;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;

import java.util.ArrayList;
import java.util.List;
import java.util.StringTokenizer;

public class MainActivity extends AppCompatActivity {

    ArrayList<String> itemArray = new ArrayList<>();
    ArrayAdapter<String> itemAdapter;
    ListView list;
    EditText itemBox;
    Button add;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        itemBox = (EditText)findViewById(R.id.itemName);
        itemAdapter = new ArrayAdapter<String>(this,android.R.layout.simple_list_item_1,itemArray);
        list = (ListView)findViewById(R.id.mylist);
        list.setAdapter(itemAdapter);
        add = (Button)findViewById(R.id.button);

        add.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        String item = itemBox.getText().toString();
                        itemArray.add(item);
                        itemAdapter.notifyDataSetChanged();
                    }
                }
        );

        list.setOnItemLongClickListener(new AdapterView.OnItemLongClickListener() {

            @Override
            public boolean onItemLongClick(AdapterView<?> parent, View view, int position, long id) {
                itemArray.remove(position);
                itemAdapter.notifyDataSetChanged();
                return true;
            }
        });


    }
}

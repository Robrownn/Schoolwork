package com.example.rob.whatismygrade;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {
    EditText    assignmentMark;
    EditText    examMark;
    Button      calculate;
    Button      clear;
    TextView    markView;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        assignmentMark = (EditText)findViewById(R.id.assignmentEnter);
        examMark =(EditText)findViewById(R.id.examEnter);
        calculate = (Button)findViewById(R.id.calculate);
        clear = (Button)findViewById(R.id.clear);
        markView = (TextView)findViewById(R.id.finalMark);

        calculate.setOnClickListener(
                new View.OnClickListener()
                {

                    @Override
                    public void onClick(View v) {
                        int assignmentValue = Integer.parseInt(assignmentMark.getText().toString());
                        int examValue = Integer.parseInt(examMark.getText().toString());

                        int finalMark = (assignmentValue/2) + (examValue/2);
                        markView.setText("Your final grade is: "+ finalMark);
                    }
                }
        );

        clear.setOnClickListener(
                new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        assignmentMark.setText("");
                        examMark.setText("");

                        markView.setText("Final Mark");
                    }
                }
        );

    }

}

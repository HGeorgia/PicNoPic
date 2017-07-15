package com.shubhamwaghe.picnopic;


import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;


/**
 * A simple {@link Fragment} subclass.
 */
public class DevelopersFragment extends Fragment {

    private static final String TITLE = "Developers";


    public DevelopersFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        ((MainActivity) getActivity()).setActionBarTitle(TITLE);

        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_developers, container, false);
    }

}

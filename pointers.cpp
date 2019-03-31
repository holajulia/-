#include <iostream>
#include "list.h"
#include <random>
 
using namespace std;
 
void sort(list* lst) {
    for (int i = 0, n = lst->size(); i < n - 1; i++){
        for (int j = 0; j < n - 1; j++){
            if (lst->find(j) > lst->find(j + 1)) {
                  int temp = lst->find(j);
                  lst->set(lst->find(j + 1), j);
                  lst->set(temp, j + 1);
            }
        }
    }
}
 
int main(int argc, char** argv) {
    int len(0);
 
    cin >> len;
 
    list lst;
 
    for (int i(0); i < len; i++){
        int k = 0;
        cin >> k;
        lst.append(k);
    }
 
//    lst.run([](const node& e) -> void {
//        cout << e << endl;
//    });
//
//    cout << lst << endl;
//
//    for (int i = 0; i < lst.size()/2; i++) {
//        int temp = lst.find(i);
//        lst.set(lst.find(lst.size() - 1 - i), i);
//        lst.set(temp, lst.size() - 1 - i);
//    }
//
//    cout << lst << endl;
 
    sort(&lst);
 
    for (int i = 0; i < len; i++) {
        cout << lst.find(i) << endl;
    }
 
    return 0;
}
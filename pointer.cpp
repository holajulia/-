#include <iostream>
 
using namespace std;
 
void sort(int* arr, int n) {
    for (int i = 0; i < n - 2; i++){
        for (int j = 0; j < n - 2; j++){
            if (arr[j] > arr[j + 1]) {
                swap(arr[j], arr[j + 1]);
            }
        }
    }
}
 
int main(int argc, char** argv) {
    int len(0);
 
    cin >> len;
 
    int* array = new int[len];
 
    for (int i(0); i < len; i++){
        cin >> array[i];
    }
 
    sort(array, len);
 
    for (int i = 0; i < len; i++) {
        cout << array[i] << endl;
    }
 
    delete[] array;
}
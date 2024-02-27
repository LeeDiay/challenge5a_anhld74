def BinarySearch(array, x, low, high):
	while low <= high:
		mid = low + (high - low) // 2
		if array[mid] == x:
			return mid
		elif array[mid] < mid:
			low = mid + 1	
		else: 
			high = mid - 1
	return -1

array = []
print("Nhap so luong phan tu cua day: ")
n = int(input())
print("Nhap phan tu cua day so: ")
for i in range(1, n+1):
	s = int(input())
	array.append(s)
print("Nhap so can tim: ")
x = int(input())

result = BinarySearch(array, x, 0, len(array))

if result !=  -1:
	print("Vi tri cua " +str(x) + " la: "+ str(result))
else:
	print("Khong tim thay gia tri can tim")
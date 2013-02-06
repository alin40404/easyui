function CellInfo(col,row,sheet,value, dval)
		{                           
			this.col=col;
			this.row=row;
			this.sheet=sheet;
			this.value=value;
			this.dval = dval;
		}      
		
    var aryCell=new Array(); 
    function openfile()
    {
    document.getElementById("DCellWeb1").openfile("D:\\test1.cll",""); 
    }
    function FillData()
   {
    
    document.getElementById("Dcellweb1").InsertRow(6, 10, 0); 
	for (i=0;i<aryCell.length;i++)         
	{  
	       if ( aryCell[i].col == 0 ) continue;
	  	   if ( aryCell[i].dval == 1 )
	        document.getElementById("Dcellweb1").SetCellDouble(parseInt(aryCell[i].col) ,parseInt(aryCell[i].row)+5,aryCell[i].sheet,aryCell[i].value);   
	       else
		    document.getElementById("Dcellweb1").SetCellString(parseInt(aryCell[i].col) ,parseInt(aryCell[i].row)+5,aryCell[i].sheet,aryCell[i].value);  
	
	} 
   }
 